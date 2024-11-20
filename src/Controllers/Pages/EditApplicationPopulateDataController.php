<?php

namespace Portal\Controllers\Pages;

use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;

class EditApplicationPopulateDataController
{
    private $model;
    private $view;


    public function __construct(ApplicantsModel $model, PhpRenderer $view)
    {
        $this->model = $model;
        $this->view = $view;

    }

    public function __invoke($request, $response, $args)
    {
        $id = $args['id'];

        $applicant = $this->model->getById($id);
        return $this->view->render($response, 'editApplicant.phtml', ['applicant' => $applicant]);
    }
}