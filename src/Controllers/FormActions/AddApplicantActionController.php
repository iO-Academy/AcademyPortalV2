<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Portal\Validators\ApplicantValidator;
use Portal\Validators\ApplicationValidator;
use Portal\ValueObjects\EmailAddress;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddApplicantActionController extends Controller
{
    private $applicantsModel;
    private $cohortsModel;
    private $authService;

    public function __construct(ApplicantsModel $applicantsModel, AuthService $authService, CohortsModel $cohortsModel)
    {
        $this->applicantsModel = $applicantsModel;
        $this->cohortsModel = $cohortsModel;
        $this->authService = $authService;
    }
    public function __invoke(Request $request, Response $response): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $newApplicant = $request->getParsedBody();

        try {
            ApplicationValidator::validate($newApplicant, $this->applicantsModel, $this->cohortsModel);
            ApplicantValidator::validate($newApplicant);
//            echo '<pre>';
//            var_dump($newApplicant);

        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/applicant/add', $e->getMessage());
        }

        $id = $this->applicantsModel->addApplicant($newApplicant);
        $this->applicantsModel->addApplication($newApplicant, $id);

        return $response->withHeader('Location', '/admin/applicants')->withStatus(301);
    }
}