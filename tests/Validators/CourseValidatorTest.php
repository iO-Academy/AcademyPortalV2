<?php

namespace Tests\Validators;

use Portal\Validators\CourseValidator;
use Tests\TestCase;

class CourseValidatorTest extends TestCase
{
    public function testValidateMissingFieldName(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('name: Missing required field');
        CourseValidator::validate(['shortName' => '']);
    }

    public function testValidateMissingFieldShortName(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('shortName: Missing required field');
        CourseValidator::validate(['name' => '']);
    }

    public function testValidateInvalidRemote(): void
    {
        $this->expectException(\Exception::class);
        CourseValidator::validate([
            'name' => 'testing',
            'shortName' => 'tst',
            'remote' => 'test'
        ]);
    }

    public function testValidateInvalidName(): void
    {
        $this->expectException(\Exception::class);
        CourseValidator::validate([
            'name' => 'testingggggggggggggg',
            'shortName' => 'tst',
            'remote' => 0
        ]);
    }

    public function testValidateInvalidShortName(): void
    {
        $this->expectException(\Exception::class);
        CourseValidator::validate([
            'name' => 'test',
            'shortName' => '',
            'remote' => 0
        ]);
    }
}
