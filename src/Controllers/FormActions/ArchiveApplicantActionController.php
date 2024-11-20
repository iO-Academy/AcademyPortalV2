<?php

namespace Portal\Controllers\FormActions;

use Portal\Models\ApplicantsModel;

class ArchiveApplicantActionController
{

    private $model;

    public function __construct(ApplicantsModel $model)
    {
        $this->model = $model;
    }

    public function __invoke($request, $response, $args)
    {
        $applicantId = $args['id'];
        $this->model->archiveApplicant($applicantId);
        return $response->withHeader('location', '/admin/applicants')->withStatus(301);
    }
}