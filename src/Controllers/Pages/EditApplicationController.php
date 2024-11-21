<?php

namespace Portal\Controllers\Pages;

use Portal\Controllers\Controller;
use Portal\Entities\Application;
use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;

class EditApplicationController extends Controller
{
    private $model;
    private $view;

    public function __construct(ApplicantsModel $model, PhpRenderer $view )
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function __invoke($request, $response)
    {
        $id = $args['id'];
        $cohorts = $this->model->getAllCohorts();
        $hearAboutUs = $this->model->getAllHearAboutUs();
        $applicant = $this->model->getById($id);
        $circumstances = $this->model->getAllCircumstances();
        $fundingOptions = $this->model->getAllFundingOptions();
        return $this->view->render($response, 'editApplicant.phtml', ['applicant' => $applicant, 'cohorts' => $cohorts, 'hearAboutUs' => $hearAboutUs,'circumstances' => $circumstances, 'fundingOptions' => $fundingOptions]);
    }
}