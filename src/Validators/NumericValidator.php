<?php

namespace Portal\Validators;

use Exception;

class NumericValidator
{
    public static function checkNumeric($num, string $fieldName): bool
    {
        if (!is_numeric($num)) {
            throw new Exception("$fieldName should be a number");
        }
        return true;
    }
}
