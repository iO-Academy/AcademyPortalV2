<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Portal\Validators\ApplicantValidator;
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

        $details = $request->getParsedBody();

//        try {
//            ApplicantValidator::validate($details);
//        } catch (Exception $e) {
//            return $this->redirectWithError($response, '/admin/applicant/edit/'.$details['id'], $e->getMessage());
//        }

        $this->model->editApplicant($details);

        return $response->withHeader('Location', '/admin/applicants')->withStatus(301);
    }
}