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

    public static function  validatePostcode ($string)
    {
        return (bool) preg_match('/^([ A-Za-z]{1,2}[0-9]{1,2}[ A-Za-z]?)\s?([0-9][A-Za-z]{2}?)$/', $string);
    }

    public static function validateDate($date, $format = 'Y-m-d'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;

    }


}
