<?php

namespace Tests\Validators;

use Portal\Validators\PhoneValidator;
use Tests\TestCase;

class testPhoneValidator extends testcase
{
    public function TestPhoneNum(){
        $testno = 567890;
        $case = PhoneValidator::validatePhone($testno);
        $this->assertTrue($case);
}

}