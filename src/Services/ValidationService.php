<?php

namespace Portal\Services;

use Exception;

class ValidationService
{
    public static function checkExists($id, $field, $fieldName): bool {
        if (!in_array($id, $field)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }
}