<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class CohortsPageController extends Controller
{
    private PhpRenderer $renderer;
    private CohortsModel $cohortsModel;
    private AuthService $authService;

    public function __construct(PhpRenderer $renderer, CohortsModel $cohortsModel, AuthService $authService)
    {
        $this->renderer = $renderer;
        $this->cohortsModel = $cohortsModel;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $cohorts = $this->cohortsModel->getAll();

        return $this->renderer->render($response, 'cohorts.phtml', ['cohorts' => $cohorts]);
    }
}
