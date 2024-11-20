<?php

namespace Portal\Validators;

use DateTime;
use Exception;

class StringValidator
{
    /**
     * @throws Exception
     */
    public static function validateLength(
        string $string,
        int $maxLength,
        int $minLength = 0,
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
