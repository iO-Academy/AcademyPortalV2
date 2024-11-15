<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AdminPageController extends Controller
{
    private PhpRenderer $renderer;
    private AuthService $authService;

    public function __construct(PhpRenderer $renderer, AuthService $authService)
    {
        $this->renderer = $renderer;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        return $this->renderer->render($response, 'admin.phtml');
    }
}
