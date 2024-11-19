<?php

namespace Tests\Validators;

use Portal\Validators\StringValidator;
use Tests\TestCase;

use function DI\string;

class StringValidatorTest extends TestCase
{
    public function testValidateLengthValidMaxLength(): void
    {
        $case = StringValidator::validateLength('test', 10);
        $this->assertTrue($case);
    }

    public function testValidateLengthValidMinAndMax(): void
    {
        $case = StringValidator::validateLength('test', 10, 2);
        $this->assertTrue($case);
    }

    public function testValidateLengthInvalidMax(): void
    {
        $this->expectException(\Exception::class);
        StringValidator::validateLength('test', 2);
    }

    public function testValidateLengthInvalidMin(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('unknown: Length invalid');
        StringValidator::validateLength('test', 10, 5);
    }

    public function testValidateLengthInvalidFieldname(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Test: Length invalid');
        StringValidator::validateLength('test', 10, 5, 'Test');
    }

    public function testValidatePostcodeLowercasePostcode(): void
    {
        $string = 'ba1 0de';
        $case = StringValidator::validatePostcode($string);
        $this->assertTrue($case);
    }
    public function testValidatePostcodeUppercasePostcode(): void
    {
        $string = 'BA32 9TL';
        $case = StringValidator::validatePostcode($string);
        $this->assertTrue($case);
    }
    public function testValidatePostcodeMixedcasePostcode(): void
    {
        $string = 'Ba32 9tL';
        $case = StringValidator::validatePostcode($string);
        $this->assertTrue($case);
    }

    public function testValidatePostcodeInvalidPostcode(): void
    {
        $string = 'invalid postcode format';
        $this->assertFalse(StringValidator::validatePostcode($string));
    }

    public function testValidatePostcodeEmptyString(): void
    {
        $string = '';
        $this->assertFalse(StringValidator::validatePostcode($string));
    }
    public function testValidDate(): void
    {
        $date = '2024-11-18';
        $result = StringValidator::validateDate($date);
        $this->assertTrue($result, 'True, valid date');
    }
    public function testInvalidDate(): void
    {
        $date = '18-11-2024';
        $result = StringValidator::validateDate($date);
        $this->assertFalse($result, 'False, invalid date');
    }
    public function testEmptyDate(): void
    {
        $date = '';
        $result = StringValidator::validateDate($date);
        $this->assertFalse($result, 'False, empty date');
    }
    public function testNullDate(): void
    {
        $date = null;
        $result = StringValidator::validateDate($date);
        $this->assertFalse($result, 'False, null date');
    }
}
