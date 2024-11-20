<?php

namespace Portal\Validators;

use Exception;

class PhoneValidator
{
    public static function validatePhone($phone)
    {
        $trimPhone = (trim($phone));

        if (strlen($trimPhone) > 15) {
            throw new Exception("$phone: Number length incorrect");
        }
        return true;
    }
}
