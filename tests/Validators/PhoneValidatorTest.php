<?php

namespace Tests\Validators;

use Portal\Validators\PhoneValidator;
use Tests\TestCase;
use TypeError;

class PhoneValidatorTest extends testcase
{
    public function testWhiteSpace()
    {
        $input = ' 01234 222 333 ';
        $expected = '01234222333';
        $actual = PhoneValidator::validatePhone($input);
        $this->assertEquals($expected, $actual);
    }

    public function testPlusSignsForSpaces()
    {
        $input = ' 01234+222+333 ';
        $expected = '01234222333';
        $actual = PhoneValidator::validatePhone($input);
        $this->assertEquals($expected, $actual);
    }

    public function testPhoneLengthTooLong()
    {
        $testno = '012342223333';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }

    public function testPhoneLengthTooShort()
    {
        $testno = '01234';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }

    public function testPhoneValid()
    {
        $input = '01234222333';
        $expected = '01234222333';
        $actual = PhoneValidator::validatePhone($input);
        $this->assertEquals($expected, $actual);
    }

    public function testPhoneInvalid(): void
    {
        $testno = 'Hello';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }

    public function testAlphaNumericChars(): void
    {
        $testno = '01H2e3l4o5';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }

    public function testNoZeroAtStart(): void
    {
        $testno = '12342223333';
        $this->expectException(\Exception::class);
        PhoneValidator::validatePhone($testno);
    }

    public function testNumberWithSpaces(): void
    {
        $input = '01234 222 333';
        $expected = '01234222333';
        $actual = PhoneValidator::validatePhone($input);
        $this->assertEquals($expected, $actual);
    }

    public function testNumberInternational(): void
    {
        $input = '+441234222333';
        $expected = '01234222333';
        $actual = PhoneValidator::validatePhone($input);
        $this->assertEquals($expected, $actual);
    }

    public function testNumberInternationalSpace(): void
    {
        $input = '+44 1234 222 333';
        $expected = '01234222333';
        $actual = PhoneValidator::validatePhone($input);
        $this->assertEquals($expected, $actual);
    }
}
