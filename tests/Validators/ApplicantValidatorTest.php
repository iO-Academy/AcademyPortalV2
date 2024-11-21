<?php

namespace Tests\Validators;

use Portal\Validators\ApplicantValidator;
use PHPUnit\Framework\TestCase;

class ApplicantValidatorTest extends TestCase
{
    public function testValidateMissingFieldName(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('name: Missing required field');
        ApplicantValidator::validate(['email' => '']);
    }

    public function testValidateMissingFieldEmail(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('email: Missing required field');
        ApplicantValidator::validate(['name' => '']);
    }

    public function testValidateInvalidName(): void
    {
        $this->expectException(\Exception::class);
        ApplicantValidator::validate([
            'name' => 'testingggggggggggggg testingggggggggggggg 
            testingggggggggggggg testingggggggggggggg testingggggggggggggg',
            'email' => 'test@test.com'
        ]);
    }

    public function testValidateInvalidEmail(): void
    {
        $this->expectException(\Exception::class);
        ApplicantValidator::validate([
            'name' => 'test',
            'email' => 'test'
        ]);
    }

    public function testValidateInvalidEmailLength(): void
    {

        $this->expectException(\Exception::class);
        ApplicantValidator::validate([
            'name' => 'name',
            'email' => 'thisisacrazyloooooooooooooooooooooooooooooooooooooooooooooo
            ooooooooooooooooooooooooooooooooooooongemail@email.com'
        ]);
    }
}
