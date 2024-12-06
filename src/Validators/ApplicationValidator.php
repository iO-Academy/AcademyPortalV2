<?php

namespace Portal\Validators;

use InvalidArgumentException;
use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;
use Portal\Services\ValidationService;

class ApplicationValidator
{
    public static function validate(
        array $application,
        ApplicantsModel $applicantsModel,
        CohortsModel $cohortsModel,
    ): array {
        $newApplication = [];

        $requiredFields = [
            'why', 'experience', 'circumstance_id',
            'funding_id', 'cohort_id', 'dob', 'phone', 'address', 'heard_about_id',
            'age_confirmation', 'eligible', 'terms'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($application[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            } else {
                $newApplication[$field] = $application[$field];
            }
        }
        StringValidator::validateLength($newApplication['why'], 65535, 0, 'Why');
        StringValidator::validateLength(
            $newApplication['experience'],
            65535,
            0,
            'Experience'
        );
        if (isset($application['diversitech'])) {
            $newApplication['diversitech'] = $application['diversitech'];
            NumericValidator::checkNumeric(
                $newApplication['diversitech'],
                'Diversitech'
            );
        } else {
            $newApplication['diversitech'] = 0;
        }
        ValidationService::checkCircumstanceOptionExists(
            $newApplication['circumstance_id'],
            $applicantsModel,
            "Circumstance ID"
        );
        NumericValidator::checkNumeric(
            $newApplication['circumstance_id'],
            "Circumstance ID"
        );
        ValidationService::checkFundingOptionExists(
            $newApplication['funding_id'],
            $applicantsModel,
            "Funding ID"
        );
        NumericValidator::checkNumeric(
            $newApplication['funding_id'],
            "Funding ID"
        );
        ValidationService::checkCohortOptionExists(
            $newApplication['cohort_id'],
            $cohortsModel,
            "Cohort ID"
        );
        NumericValidator::checkNumeric(
            $newApplication['cohort_id'],
            "Cohort ID"
        );
        StringValidator::validateLength($newApplication['phone'], 15, 0, 'phone');
        $newApplication['phone'] = PhoneValidator::validatePhone($newApplication['phone']);
        StringValidator::validateLength(
            $newApplication['address'],
            200,
            0,
            'Address'
        );
        ValidationService::checkHeardAboutOptionExists(
            $newApplication['heard_about_id'],
            $applicantsModel,
            "Heard About ID"
        );
        NumericValidator::checkNumeric(
            $newApplication['heard_about_id'],
            "Hear About ID"
        );
        NumericValidator::checkNumeric(
            $newApplication['age_confirmation'],
            "Age confirmation"
        );
        if (isset($application['newsletter'])) {
            $newApplication['newsletter'] = $application['newsletter'];
            NumericValidator::checkNumeric(
                $newApplication['newsletter'],
                'newsletter'
            );
        } else {
            $newApplication['newsletter'] = 0;
        }
        NumericValidator::checkNumeric(
            $newApplication['eligible'],
            "Eligible"
        );
        NumericValidator::checkNumeric(
            $newApplication['terms'],
            "Terms"
        );

        return $newApplication;
    }
}
