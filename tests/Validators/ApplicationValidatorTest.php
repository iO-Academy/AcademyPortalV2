<?php
namespace Tests\Validators;

use Portal\Validators\ApplicationValidator;
use PHPUnit\Framework\TestCase;

class ApplicationValidatorTest extends TestCase
{
    public function testValidateValidData(): void
    {
        $this->assertTrue(ApplicationValidator::validate([
            'why' => 'I want to join this program because I am passionate about coding.',
            'experience' => 'I have 3 years of experience working on personal and freelance projects.',
            'phone' => '07123456789',
            'address' => '123 Test Street, Test City, TE 12345',
            'dob' => '1990-05-15',
            'circumstance_id' => 1,
            'funding_id' => 1,
            'cohort_id' => 1,
            'heard_about_id' => 1,
            'diversitech' => 1,
            'age_confirmation' => 1,
            'newsletter' => 0,
            'eligible' => 1,
            'terms' => 1
            ]));
    }

    public function testMissingWhyField(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Why is required.');
        ApplicationValidator::validate([
            'experience' => 'I have 2 years of experience as a junior developer.',
            'phone' => '0123456789',
            'address' => '123 Test Street, Test City, TE 12345',
        ]);
    }

    public function testValidateInvalidBooleanFields(): void
    {
        $this->expectException(\Exception::class);
        ApplicationValidator::validate([
            'why' => 'I love coding',
            'experience' => '5 years coding.',
            'diversitech' => 1,
            'age_confirmation' => 0,
            'eligible' => 1,
            'terms' => 1,
        ]);
    }

    public function testValidateRequiredFieldsExist()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('name: Missing required field');
        ApplicationValidator::validate([
            'why' => '',
            'experience' => '',
            'diversitech' => 1,
            'age_confirmation' => 1,
            'eligible' => 1,
            'terms' => 1,
            'phone' => ''
        ]);   
    }

    public function testWhyFieldExceedsMaxLength(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Why is too long.');
        ApplicationValidator::validate([
            'why' => str_repeat('a', 65536), // Exceeds max length of 65535
            'experience' => 'I have 2 years of experience as a junior developer.',
            'phone' => '0123456789',
            'address' => '123 Test Street, Test City, TE 12345',
        ]);
    }

    public function testInvalidPhoneNumber(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid phone number.');
        ApplicationValidator::validate([
            'why' => 'I am passionate about coding and want to improve my skills.',
            'experience' => 'I have 2 years of experience.',
            'phone' => 'oseven42768',
            'address' => '123 Test Street, Test City, TE 12345',
        ]);
    }

    public function testMissingAddress(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Address is required.');
        ApplicationValidator::validate([
            'why' => 'I am passionate about coding and want to improve my skills.',
            'experience' => 'I have 2 years of experience.',
            'phone' => '07123456789',
        ]);
    }
}