<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Portal\Validators\ApplicantValidator;
use Portal\Validators\ApplicationValidator;
use Portal\ValueObjects\EmailAddress;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddApplicantActionController extends Controller
{
    private $model;
    private $authService;

    public function __construct(ApplicantsModel $model, AuthService $authService)
    {
        $this->model = $model;
        $this->authService = $authService;
    }
    public function __invoke(Request $request, Response $response): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $newApplicant = $request->getParsedBody();

        try {
            ApplicationValidator::validate($newApplicant, $this->model);
            ApplicantValidator::validate($newApplicant);

        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/applicant/add', $e->getMessage());
        }

        $id = $this->model->addApplicant($newApplicant);
        $this->model->addApplication($newApplicant, $id);

        return $response->withHeader('Location', '/admin/applicants')->withStatus(301);
    }
}