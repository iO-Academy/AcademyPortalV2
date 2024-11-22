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
        StringValidator::validateLength($newApplicant['email'], 255, 1, 'Name');
        $newApplicant['email'] = new EmailAddress($applicant['email']);

        return $newApplicant;
    }

    public static function validateEdit(array $Application): array
    {
        $editedApplication = [];

        $requiredFields = ['id', 'name', 'email'];

        foreach ($requiredFields as $field){
            if (!isset($Application[$field])) {
                throw new InvalidArgumentException("$field: Missing required field");
            } else {
                $editedApplication[$field] = $Application[$field];
            }
        }

        NumericValidator::checkNumeric($editedApplication['id'], 'id',);
        StringValidator::validateLength($editedApplication['name'], 100, 1, 'Name');
        StringValidator::validateLength($editedApplication['email'], 255, 1, 'Name');
        $newApplicant['email'] = new EmailAddress($Application['email']);

        return $newApplicant;
    }
}
