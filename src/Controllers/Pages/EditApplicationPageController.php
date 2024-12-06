<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Entities\Application;
use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;

class EditApplicationPageController extends Controller
{
    private $model;
    private $view;
    private ApplicantsModel $applicantsModel;
    private CohortsModel $cohortsModel;
    private AuthService $authService;


    public function __construct(
        ApplicantsModel $model,
        PhpRenderer $view,
        AuthService $authService,
        ApplicantsModel $applicantsModel,
        CohortsModel $cohortsModel
    ) {
        $this->model = $model;
        $this->view = $view;
        $this->authService = $authService;
        $this->applicantsModel = $applicantsModel;
        $this->cohortsModel = $cohortsModel;
    }

    public function __invoke($request, $response, $args = []): Response
    {
        $circumstances = $this->applicantsModel->getAllCircumstanceOptions();
        $fundingOptions = $this->applicantsModel->getAllFundingOptions();
        $cohorts = $this->cohortsModel->getAll();
        $hearAboutUs = $this->applicantsModel->getAllHearAboutUsOptions();
        $id = $args['id'];
        $applicant = $this->model->getById($id);

        $query = $request->getQueryParams();

        return $this->view->render(
            $response,
            'editApplicant.phtml',
            ['applicant' => $applicant,
                'cohorts' => $cohorts,
                'hearAboutUs' => $hearAboutUs,
                'circumstances' => $circumstances,
                'fundingOptions' => $fundingOptions,
                'error' => $query['error'] ?? null]
        );
    }
}
