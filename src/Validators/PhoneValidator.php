<?php

namespace Portal\Validators;

use Exception;

class PhoneValidator

{
    public static function validatePhone($phone)
    {
        $trimPhone = (trim($phone));

        if (!$trimPhone) {
            throw new Exception("$phone: Missing telephone number");
        }elseif (!ctype_digit($trimPhone)){
            throw new Exception("$phone: Must be a valid telephone number");
        }elseif(strlen($trimPhone) !=11){
            throw new Exception("$phone: Number length incorrect");
        }
    return true;

    }
}