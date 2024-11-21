<?php

namespace Portal\Controllers\FormActions;

use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;


class ArchiveApplicantActionController extends Controller
{

    private $model;

    private $authService;

    public function __construct(ApplicantsModel $model, AuthService $authService)
    {
        $this->model = $model;
        $this->authService = $authService;
    }

    public function __invoke($request, $response): Response
    {

        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }





        return $response->withHeader('location', '/admin/applicants')->withStatus(301);
    }
}