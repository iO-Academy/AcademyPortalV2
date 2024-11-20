<?php

namespace Portal\Validators;

use Exception;
use Portal\Models\CohortsModel;
use Portal\Services\ValidationService;

class ApplicationValidator
{
    public static function validate(array $application, $applicantsModel, CohortsModel $cohorts): bool
    {
        StringValidator::validateLength($application['why'], 65535, 0, 'Why');
        StringValidator::validateLength(
            $application['experience'],
            65535,
            0,
            'Experience'
        );
        PhoneValidator::validatePhone($application['phone']);
        StringValidator::validateLength(
            $application['address'],
            200,
            0,
            'Address'
        );
        NumericValidator::checkNumeric(
            $application['circumstance_id'],
            "Circumstance ID"
        );
        NumericValidator::checkNumeric(
            $application['funding_id'],
            "Funding ID"
        );
        NumericValidator::checkNumeric(
            $application['cohort_id'],
            "Cohort ID"
        );
        NumericValidator::checkNumeric(
            $application['heard_about_id'],
            "Heard About ID"
        );

        ValidationService::checkCircumstanceOptionExists(
            $application['circumstance_id'],
            $applicantsModel->getAllCircumstanceOptions()[$application['circumstance_id'] - 1],
            "Circumstance ID"
        );
        ValidationService::checkFundingOptionExists(
            $application['funding_id'],
            $applicantsModel->getAllFundingOptions()[$application['funding_id'] - 1],
            "Funding ID"
        );
        ValidationService::checkCohortOptionExists(
            $application['cohort_id'],
            $cohorts->getAll()[$application['cohort_id'] - 1 ]->getId(),
            "Cohort ID"
        );
        ValidationService::checkHeardAboutOptionExists(
            $application['heard_about_id'],
            $applicantsModel->getAllHearAboutUsOptions()[$application['heard_about_id'] - 1],
            "Heard About ID"
        );

        return true;
    }
}
