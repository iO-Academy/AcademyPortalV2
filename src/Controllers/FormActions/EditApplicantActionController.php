<?php

namespace Portal\Controllers\FormActions;

use ErrorException;
use Portal\Models\ApplicantsModel;
use Portal\Validators\StringValidator;
use Portal\ValueObjects\EmailAddress;

class EditApplicantActionController
{
    private $model;
    public function __construct(ApplicantsModel $model)
    {
        $this->model = $model;
    }
    public function __invoke($request, $response, $args)
    {
        $details = $request->getParsedBody();
        $validatedDetails = [];
        $validatedDetails['name'] = StringValidator::validateLength($details['name'], 100, 1, 'Name');
        $validatedDetails['email'] = new EmailAddress($details['email']);
        $validatedDetails['date'] = $details['date']; //add date validator


        $this->model->editApplicant($validatedDetails);
//        return $this->view->render($response, 'editApplicant.phtml', ['applicant' => $applicant]);
    }
}