<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class SingleApplicantPageController extends Controller
{
    private PhpRenderer $renderer;
    private ApplicantsModel $applicantsModel;
    private AuthService $authService;

    public function __construct(PhpRenderer $renderer, ApplicantsModel $applicantsModel, AuthService $authService)
    {
        $this->renderer = $renderer;
        $this->applicantsModel = $applicantsModel;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $id = $args['id'];

        $applicant = $this->applicantsModel->getById($id);

        return $this->renderer->render($response, 'singleApplicant.phtml', ['applicant' => $applicant]);
    }
}
