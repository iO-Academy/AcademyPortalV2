<?php

namespace Portal\Validators;

use Exception;

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

    /**
     * @throws Exception
     */
    public static function checkExists($id, $field, $fieldName): bool {
        if (!in_array($id, $field)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    /**
     * @throws Exception
     */
    public static function checkNumeric($num, $fieldName): bool {
        if (!is_numeric($num)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

}