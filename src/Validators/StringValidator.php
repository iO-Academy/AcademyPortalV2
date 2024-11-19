<?php

namespace Portal\Validators;

use Exception;

class StringValidator
{
    /**
     * @throws Exception
     */
    public static function validateLength(
        string $string,
        int    $maxLength = 255,
        int    $minLength = 0,
        string $fieldName = 'unknown'
    ): bool
    {
        $len = strlen($string);

        if ($len < $minLength || $len > $maxLength) {
            throw new Exception("$fieldName: Length invalid");
        }
        return true;
    }
}
