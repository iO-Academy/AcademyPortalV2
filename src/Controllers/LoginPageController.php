<?php

namespace Portal\Controllers;

use Portal\Services\AuthService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class LoginPageController
{
    private PhpRenderer $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        if (AuthService::isLoggedIn()) {
            return $response->withHeader('Location', "./admin")->withStatus(301);
        }

        $query = $request->getQueryParams();

        $data = [
            'email_error' => $query['email_error'] ?? null,
            'error' => $query['error'] ?? null
        ];


        return $this->renderer->render($response, 'login.phtml', $data);
    }
}
