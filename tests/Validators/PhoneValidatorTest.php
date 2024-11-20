<?php

namespace Tests\Validators;

use Portal\Validators\PhoneValidator;
use Tests\TestCase;
use TypeError;

class PhoneValidatorTest extends testcase
{
    public function testPhoneValid()
    {
        $testno = '03275334442';
        $case = PhoneValidator::validatePhone($testno);
        $this->assertTrue($case);
    }

    public function testPhoneInvalid(): void
    {
        $testno = 'Hello';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }

    public function testPhoneLengthInvalid()
    {
        $testno = '0327533';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }
}
