<?php

namespace Portal\Validators;

use Exception;

class PhoneValidator

{
    public static function validatePhone($phone)
    {

        $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

        $match = preg_match($pattern,$phone);

        if ($match != false) {
            return true;
        } else {
            if (!isset($phone)) {
                throw new Exception("$phone: Missing telephone number");
            }

        if (isset($course['remote']) && $course['remote'] != 1) {
            throw new Exception('Remote: Invalid');
        }

    }
}
}