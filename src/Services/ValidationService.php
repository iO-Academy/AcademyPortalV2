<?php

namespace Portal\Services;

use Exception;

class ValidationService
{
    public static function checkCircumstanceOptionExists($id, $db, $fieldName): bool
    {
        if (!in_array($id, $db)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    public static function checkFundingOptionExists($id, $db, $fieldName): bool
    {
        if (!in_array($id, $db)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    public static function checkCohortOptionExists($id, $db, $fieldName): bool
    {
        if (!$id === $db) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    public static function checkHeardAboutOptionExists($id, $db, $fieldName): bool
    {
        if (!in_array($id, $db)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }
}