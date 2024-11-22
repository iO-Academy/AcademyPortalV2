<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Models\CoursesModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class CoursesPageController extends Controller
{
    private PhpRenderer $renderer;
    private CoursesModel $coursesModel;
    private AuthService $authService;

    public function __construct(PhpRenderer $renderer, CoursesModel $coursesModel, AuthService $authService)
    {
        $this->renderer = $renderer;
        $this->coursesModel = $coursesModel;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $courses = $this->coursesModel->getAll();

        return $this->renderer->render($response, 'courses.phtml', ['courses' => $courses]);
    }
}
