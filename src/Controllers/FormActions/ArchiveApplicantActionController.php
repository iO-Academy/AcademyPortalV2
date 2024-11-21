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
            ApplicationValidator::checkExists($newApplicant['circumstance_id'], $this->model->getAllCircumstances()[$newApplicant['circumstance_id'] - 1], "Circumstance ID");
            ApplicationValidator::checkNumeric($newApplicant['circumstance_id'], "Circumstance ID");
            ApplicationValidator::checkExists($newApplicant['funding_id'], $this->model->getAllFundingOptions()[$newApplicant['funding_id'] - 1], "Funding ID");
            ApplicationValidator::checkNumeric($newApplicant['funding_id'], "Funding ID");
            ApplicationValidator::checkExists($newApplicant['cohort_id'], $this->model->getAllCohorts()[$newApplicant['cohort_id'] - 1], "Cohort ID");
            ApplicationValidator::checkNumeric($newApplicant['cohort_id'], "Cohort ID");
            ApplicationValidator::checkExists($newApplicant['heard_about_id'], $this->model->getAllHearAboutUs()[$newApplicant['heard_about_id'] - 1], "Heard About ID");
            ApplicationValidator::checkNumeric($newApplicant['heard_about_id'], "Heard About ID");

        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/applicant/add', $e->getMessage());
        }


        $id = $this->model->addApplicant($newApplicant);
        $this->model->addApplication($newApplicant, $id);

        return $response->withHeader('Location', '/admin/archive')->withStatus(301);
    }
}