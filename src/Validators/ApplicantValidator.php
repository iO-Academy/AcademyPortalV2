<?php

namespace Portal\Validators;

use Exception;
use InvalidArgumentException;
use Portal\ValueObjects\EmailAddress;

class ApplicantValidator
{
    /**
     * @throws InvalidArgumentException|Exception
     */
    public static function validate(array $applicant): array
    {
        $newApplicant = [];

        $requiredFields = ['name', 'email'];

        foreach ($requiredFields as $field) {
            if (!isset($applicant[$field])) {
                throw new InvalidArgumentException("$field: Missing required field");
            } else {
                $newApplicant[$field] = $applicant[$field];
            }
        }

        StringValidator::validateLength($newApplicant['name'], 100, 1, 'Name');
        StringValidator::validateLength($newApplicant['email'], 255, 1, 'Email');
        $newApplicant['email'] = new EmailAddress($applicant['email']);

        return $newApplicant;
    }
}
