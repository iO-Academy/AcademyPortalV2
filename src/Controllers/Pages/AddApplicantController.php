<?php

namespace Portal\Controllers\Pages;

use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;

class AddApplicantController
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
        $newApplicant = $request->getParsedBody();
        $this->model->addApplicant($newApplicant);
        return $response->withHeader('Location', '/admin/applicants')->withStatus(301);
    }
}