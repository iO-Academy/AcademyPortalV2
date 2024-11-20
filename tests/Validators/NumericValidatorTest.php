<?php

namespace Tests\Validators;

use Portal\Validators\NumericValidator;
use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase
{
    public function testCheckNumericInvalidInput(): void
    {
        $input = "Hello";
        $fieldName = "Cohort";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cohort should be a number");
        NumericValidator::checkNumeric($input, $fieldName);
    }

    public function testCheckNumericSuccess(): void
    {
        $input = "1";
        $fieldName = "Cohort";
        $case = NumericValidator::checkNumeric($input, $fieldName);
        $this->assertTrue($case);
    }

    public function testCheckNumericNull(): void
    {
        $input = null;
        $fieldName = "Cohort";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cohort should be a number");
        NumericValidator::checkNumeric($input, $fieldName);
    }

}
