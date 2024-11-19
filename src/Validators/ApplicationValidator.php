<?php

namespace Portal\Validators;

class ApplicationValidator
{
    public static function validate(array $application): bool
    {

        StringValidator::validateLength($application['why'], 65535, 0, 'Why');
        StringValidator::validateLength($application['experience'], 65535, 0, 'Experience');
        PhoneValidator::validatePhone($application['phone']);
        StringValidator::validateLength($application['address'], 200, 0, 'Address');

        return true;
    }
}