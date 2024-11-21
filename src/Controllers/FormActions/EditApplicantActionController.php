<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Portal\Validators\ApplicantValidator;
use Portal\Validators\ApplicationValidator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EditApplicantActionController extends Controller
{
    private $model;
    private $authService;

    public function __construct(ApplicantsModel $model, AuthService $authService)
    {
        $this->model = $model;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $details = $request->getParsedBody();
        $details['id'] = $args['id'];

//        try {
//            ApplicantValidator::validate($details);
//            ApplicationValidator::validate($details);
//        } catch (Exception $e) {
//            return $this->redirectWithError($response, '/admin/applicant/edit/'.$details['id'], $e->getMessage());
//        }

        $this->model->editApplicant($details);

        return $response->withHeader('Location', '/admin/applicants')->withStatus(301);
    }
}