<?php

namespace Portal\Validators;

use InvalidArgumentException;

class PhoneValidator
{
    public static function validatePhone($phone)
    {
        $triminter = preg_replace("/^\+44/", "0", $phone);
        $trimspace = preg_replace("/[^0-9]/", "", $triminter);
        $match = filter_var($trimspace, FILTER_VALIDATE_REGEXP, ["options" => [ "regexp" => "/^0\d{10}$/"]]);

        if (!$match) {
            throw new InvalidArgumentException("$phone: Must be a valid phone number");
        } else {
            return $match;
        }
    }
}
