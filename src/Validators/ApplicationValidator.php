<?php

namespace Portal\Validators;

use Exception;
use InvalidArgumentException;
use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;
use Portal\Services\ValidationService;

class ApplicationValidator
{
    public static function validate(array $application, ApplicantsModel $applicantsModel, CohortsModel $cohortsModel): bool
    {

        $requiredFields = [
            'why', 'experience', 'circumstance_id',
            'funding_id', 'cohort_id', 'dob', 'phone', 'address', 'heard_about_id',
            'age_confirmation', 'eligible', 'terms'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($application[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }

        StringValidator::validateLength($application['why'], 65535, 1, 'Why');
        StringValidator::validateLength(
            $application['experience'],
            65535,
            1,
            'Experience'
        );
        StringValidator::validateLength(
            $application['dob'],
            10,
            1,
            'Date of Birth'
        );
        StringValidator::validateLength(
            $application['address'],
            200,
            1,
            'Address'
        );
        PhoneValidator::validatePhone($application['phone']);
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
            $applicantsModel,
            "Circumstance ID"
        );
        ValidationService::checkFundingOptionExists(
            $application['funding_id'],
            $applicantsModel,
            "Funding ID"
        );
        ValidationService::checkCohortOptionExists(
            $application['cohort_id'],
            $cohortsModel,
            "Cohort ID"
        );
        ValidationService::checkHeardAboutOptionExists(
            $application['heard_about_id'],
            $applicantsModel,
            "Heard About ID"
        );

        return true;
    }
}
