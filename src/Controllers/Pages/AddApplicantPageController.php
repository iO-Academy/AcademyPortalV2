<?php

namespace Portal\Controllers\Pages;

use PharIo\Manifest\Application;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddApplicantPageController extends Controller
{
    private PhpRenderer $view;
    private ApplicantsModel $applicantsModel;
    private CohortsModel $cohortsModel;
    private AuthService $authService;

    public function __construct(
        PhpRenderer $view,
        AuthService $authService,
        ApplicantsModel $applicantsModel,
        CohortsModel $cohortsModel
    ) {
        $this->view = $view;
        $this->authService = $authService;
        $this->applicantsModel = $applicantsModel;
        $this->cohortsModel = $cohortsModel;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $circumstanceOptions = $this->applicantsModel->getAllCircumstanceOptions();
        $fundingOptions = $this->applicantsModel->getAllFundingOptions();
        $cohorts = $this->cohortsModel->getAll();
        $hearAboutUsOptions = $this->applicantsModel->getAllHearAboutUsOptions();

        return $this->view->render($response, "addApplicant.phtml", [
            'circumstances' => $circumstanceOptions,
            'funding' => $fundingOptions,
            'cohorts' => $cohorts,
            'hearAboutUs' => $hearAboutUsOptions
        ]);
    }
}
