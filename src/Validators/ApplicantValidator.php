<?php

namespace Portal\Validators;

use Exception;
use Portal\ValueObjects\EmailAddress;

class ApplicantValidator
{
    /**
     * @throws Exception
     */
    public static function validate(array $applicant): bool
    {

        $requiredFields = ['name', 'email'];

        foreach ($requiredFields as $field) {
            if (!isset($applicant[$field])) {
                throw new Exception("$field: Missing required field");
            }
        }

        $email = new EmailAddress($applicant['email']);
        StringValidator::validateLength($applicant['name'], 100, 1, 'Name');
        StringValidator::validateLength($email, 255, 1, 'Name');


        return true;
    }
}