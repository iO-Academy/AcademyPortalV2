<?php

namespace Portal\Validators;

use Exception;
use Portal\Services\ValidationService;

class ApplicationValidator
{


    public static function validate(array $application, $fieldOptions): bool
    {

//        $fields = ["circumstance_id", "funding_id", "cohort_id", "heard_about_id"];
//
//        foreach ($fields as $field) {
//            if (!in_array($application[$field], $fieldOptions->getAllCircumstances()[$application['circumstance_id'] - 1])) {
//                throw new Exception("$field: Missing required field");
//            }
//        }



//    {
//        if (!in_array($id, $field)) {
//            throw new Exception("$fieldName doesn't exist");
//        }
//        return true;
//    }

        StringValidator::validateLength($application['why'], 65535, 0, 'Why');
        StringValidator::validateLength($application['experience'], 65535, 0, 'Experience');
        PhoneValidator::validatePhone($application['phone']);
        StringValidator::validateLength($application['address'], 200, 0, 'Address');
        NumericValidator::checkNumeric($application['circumstance_id'], "Circumstance ID");
        NumericValidator::checkNumeric($application['funding_id'], "Funding ID");
        NumericValidator::checkNumeric($application['cohort_id'], "Cohort ID");
        NumericValidator::checkNumeric($application['heard_about_id'], "Heard About ID");
        ValidationService::checkExists($application['circumstance_id'], $fieldOptions->getAllCircumstances()[$application['circumstance_id'] - 1], "Circumstance ID");
        ValidationService::checkExists($application['funding_id'], $fieldOptions->getAllFundingOptions()[$application['funding_id'] - 1], "Funding ID");
        ValidationService::checkExists($application['cohort_id'], $fieldOptions->getAllCohorts()[$application['cohort_id'] - 1], "Cohort ID");
        ValidationService::checkExists($application['heard_about_id'], $fieldOptions->getAllHearAboutUs()[$application['heard_about_id'] - 1], "Heard About ID");

        return true;
    }
}