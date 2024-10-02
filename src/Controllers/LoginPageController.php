<?php

namespace Portal\Controllers;

use Portal\Services\AuthService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class LoginPageController extends Controller
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
        if ($this->authService->isLoggedIn()) {
            return $this->redirect($response, '/admin');
        }

        $query = $request->getQueryParams();

        $data = [
            'email_error' => $query['email_error'] ?? null,
            'error' => $query['error'] ?? null
        ];

        return $this->renderer->render($response, 'login.phtml', $data);
    }
}
