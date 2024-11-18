<?php

namespace Portal\Controllers\Pages;

use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;

class EditApplicationController
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
        $Applicant = $request->getParsedBody();
        $this->model->editApplicant($Applicant);
        return $response->withHeader('Location', '/admin/applicant/edit/{id}')->withStatus(301);
    }
}