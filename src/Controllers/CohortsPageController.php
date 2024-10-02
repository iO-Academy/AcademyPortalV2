<?php

namespace Portal\Controllers;

use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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

    public function __invoke(Request $request, Response $response): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $cohorts = $this->cohortsModel->getAll();

        return $this->renderer->render($response, 'cohorts.phtml', ['cohorts' => $cohorts]);
    }
}
