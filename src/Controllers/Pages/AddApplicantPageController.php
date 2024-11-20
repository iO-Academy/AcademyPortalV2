<?php

namespace Portal\Controllers\Pages;

use PharIo\Manifest\Application;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddApplicantPageController extends Controller
{
    private PhpRenderer $view;
    private ApplicantsModel $model;
    private AuthService $authService;

    public function __construct(PhpRenderer $view, AuthService $authService, ApplicantsModel $model)
    {
        $this->view = $view;
        $this->authService = $authService;
        $this->model = $model;

    }

    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $circumstanceOptions = $this->model->getAllCircumstanceOptions();
        $fundingOptions = $this->model->getAllFundingOptions();
        $cohorts = $this->model->getAllCohorts();
        $hearAboutUsOptions = $this->model->getAllHearAboutUsOptions();


        return $this->view->render($response, "addApplicant.phtml", [
            'circumstances' => $circumstanceOptions,
            'funding' => $fundingOptions,
            'cohorts' => $cohorts,
            'hearAboutUs' => $hearAboutUsOptions
        ]);
    }

}