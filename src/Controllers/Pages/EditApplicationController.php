<?php

namespace Portal\Controllers\Pages;

use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;

class EditApplicationController
{
    private $model;
    private $view;
    private ApplicantsModel $applicantsModel;

    public function __construct(ApplicantsModel $model, PhpRenderer $view, ApplicantsModel $applicantsModel)
    {
        $this->model = $model;
        $this->view = $view;
        $this->applicantsModel = $applicantsModel;
    }

    public function __invoke($request, $response, $args)
    {
        $id = $args['id'];

        $applicant = $this->applicantsModel->getById($id);
        return $this->view->render($response, 'editApplicant.phtml', ['applicant' => $applicant]);
    }
}