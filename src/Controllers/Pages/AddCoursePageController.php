<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddCoursePageController extends Controller
{
    private PhpRenderer $renderer;
    private AuthService $authService;

    public function __construct(PhpRenderer $renderer, AuthService $authService)
    {
        $this->renderer = $renderer;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $query = $request->getQueryParams();

        $data = [
            'error' => $query['error'] ?? null
        ];

        return $this->renderer->render($response, 'addCourse.phtml', $data);
    }
}
