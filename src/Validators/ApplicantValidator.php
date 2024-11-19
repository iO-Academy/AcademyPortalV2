<?php

namespace Portal\Validators;

use Exception;
use Portal\ValueObjects\EmailAddress;

class ApplicantValidator
{
    public static function validate(array $applicant): bool
    {

        $requiredFields = ['name', 'email'];

        foreach ($requiredFields as $field) {
            if (!isset($applicant[$field])) {
                throw new Exception("$field: Missing required field");
            }
        }

        StringValidator::validateLength($applicant['name'], 50, 2, 'Name');

        return true;
    }
}