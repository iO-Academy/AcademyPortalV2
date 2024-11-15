<?php

namespace Portal\Validators;

use Exception;

class CourseValidator
{
    /**
     * @throws Exception
     */
    public static function validate(array $course): bool
    {

        $requiredFields = ['name', 'shortName'];

        foreach ($requiredFields as $field) {
            if (!isset($course[$field])) {
                throw new Exception("$field: Missing required field");
            }
        }

        if (isset($course['remote']) && $course['remote'] != 1) {
            throw new Exception('Remote: Invalid');
        }

        StringValidator::validateLength($course['name'], 50, 2, 'Name');
        StringValidator::validateLength($course['shortName'], 5, 2, 'Short Name');

        return true;
    }
}
