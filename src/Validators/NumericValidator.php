<?php

namespace Portal\Validators;

use Exception;

class NumericValidator
{
    public static function checkNumeric($num, $fieldName): bool {
        if (!is_numeric($num)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }
}