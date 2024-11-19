<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Portal\Validators\ApplicantValidator;
use Portal\Validators\ApplicationValidator;
use Portal\ValueObjects\EmailAddress;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddApplicantActionController extends Controller
{
    private $model;
    private $authService;

    public function __construct(ApplicantsModel $model, AuthService $authService)
    {
        $this->model = $model;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $newApplicant = $request->getParsedBody();

        try {
            ApplicantValidator::validate($newApplicant);
            ApplicationValidator::validate($newApplicant);

            $circumstances = $this->model->getAllCircumstances();
            if (!is_numeric($newApplicant['circumstance_id']) && !in_array($newApplicant['circumstance_id'], $circumstances)) {
                throw new Exception("Circumstance ID doesn't exist");
            }

            $fundingOptions = $this->model->getAllFundingOptions();
            if (!is_numeric($newApplicant['funding_id']) && !in_array($newApplicant['funding_id'], $fundingOptions)) {
                throw new Exception("Funding ID doesn't exist");
            }

            $cohorts = $this->model->getAllCohorts();
            if (!is_numeric($newApplicant['cohorts_id']) && !in_array($newApplicant['cohort_id'], $cohorts)) {
                throw new Exception("Cohort ID doesn't exist");
            }

            $heardAbouts = $this->model->getAllHearAboutUs();
            if (!in_array($newApplicant['heard_about_id'], $heardAbouts)) {
                throw new Exception("Heard About ID doesn't exist");
            }



        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/applicant/add', $e->getMessage());
        }

        $this->model->addApplicant($newApplicant);

        return $response->withHeader('Location', '/admin/applicant')->withStatus(301);
    }
}