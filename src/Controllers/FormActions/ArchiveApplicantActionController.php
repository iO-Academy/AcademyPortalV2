<?php

namespace Portal\Controllers\FormActions;

use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ArchiveApplicantActionController extends Controller
{
    private $model;
    private $authService;

    public function __construct(ApplicantsModel $model, AuthService $authService)
    {
        $this->model = $model;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $applicantId = $args['id'];
        $this->model->archiveApplicant($applicantId);
        return $response->withHeader('location', '/admin/applicants')->withStatus(301);
    }
}
