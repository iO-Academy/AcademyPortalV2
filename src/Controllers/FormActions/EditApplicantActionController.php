<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Portal\Validators\ApplicantValidator;
use Portal\Validators\ApplicationValidator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EditApplicantActionController extends Controller
{
    private $applicantsModel;
    private $cohortsModel;
    private $authService;

    public function __construct(ApplicantsModel $applicantsModel, AuthService $authService, CohortsModel $cohortsModel)
    {
        $this->applicantsModel = $applicantsModel;
        $this->authService = $authService;
        $this->cohortsModel= $cohortsModel;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $input = $request->getParsedBody();
        //$input['id'] = $args['id'];  THIS NEEDS TO BE SET IN THE VALIDATOR
        $hasApplication = false;

        try {
            $changedApplicant = ApplicantValidator::validateEdit($input);
           // $changedApplicant['id'] = $args['id'];  WORK AROUND THAT NEEDS TO BE FIXED THROUGH VALIDATOR
        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/applicants/edit/'.$input['id'], $e->getMessage());
        }

        try {
            $changedApplicant = ApplicationValidator::validate($input, $this->applicantsModel, $this->cohortsModel);
            $hasApplication = true;
        } catch (Exception $e) {
            $hasApplication = false;
        }

        try {
            $this->applicantsModel->editApplicant($changedApplicant);
            if ($hasApplication) {
                $this->applicantsModel->editApplication($changedApplicant);
            }
        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/applicants/edit/'.$input['id'], $e->getMessage());
        }

        return $response->withHeader('Location', '/admin/applicants')->withStatus(301);
    }
}