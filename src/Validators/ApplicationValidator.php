<?php

namespace Portal\Validators;

use Exception;
use Portal\Services\ValidationService;

class ApplicationValidator
{
    public static function validate(array $application, $db): bool
    {
        StringValidator::validateLength($application['why'], 65535, 0, 'Why');
        StringValidator::validateLength($application['experience'], 65535, 0,
            'Experience');
        PhoneValidator::validatePhone($application['phone']);
        StringValidator::validateLength($application['address'], 200, 0, 'Address');
        NumericValidator::checkNumeric($application['circumstance_id'], "Circumstance ID");
        NumericValidator::checkNumeric($application['funding_id'], "Funding ID");
        NumericValidator::checkNumeric($application['cohort_id'], "Cohort ID");
        NumericValidator::checkNumeric($application['heard_about_id'], "Heard About ID");

        ValidationService::checkCircumstanceOptionExists($application['circumstance_id'],
            $db->getAllCircumstances()[$application['circumstance_id'] - 1], "Circumstance ID");
        ValidationService::checkFundingOptionExists($application['funding_id'],
            $db->getAllFundingOptions()[$application['funding_id'] - 1], "Funding ID");
        ValidationService::checkCohortOptionExists($application['cohort_id'],
            $db->getAllCohorts()[$application['cohort_id'] - 1], "Cohort ID");
        ValidationService::checkHeardAboutOptionExists($application['heard_about_id'],
            $db->getAllHearAboutUs()[$application['heard_about_id'] - 1], "Heard About ID");

        return true;
    }
}