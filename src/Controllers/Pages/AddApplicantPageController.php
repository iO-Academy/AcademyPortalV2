<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddApplicantPageController extends Controller
{
    private PhpRenderer $view;
    private AuthService $authService;

    public function __construct(PhpRenderer $view, AuthService $authService)
    {
        $this->view = $view;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        return $this->view->render($response, "addApplicant.phtml", $args);
    }

}