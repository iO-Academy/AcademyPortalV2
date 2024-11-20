<?php

namespace Tests\Services;

use Portal\Services\ValidationService;
use PHPUnit\Framework\TestCase;

class ValidationServiceTest extends TestCase
{
    public function testCheckCircumstanceOptionExistsFailure()
    {
        $id = 1;
        $arr = [2, 3, 4];
        $field = "Circumstance";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Circumstance doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckCircumstanceOptionExistsSuccess()
    {
        $id = 1;
        $arr = [2, 1, 4];
        $field = "Circumstance";
        $case = ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
        $this->assertTrue($case);
    }

    public function testCheckCircumstanceOptionExistsNull()
    {
        $id = null;
        $arr = [2, 1, 4];
        $field = "Circumstance";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Circumstance doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckFundingOptionExistsFailure()
    {
        $id = 1;
        $arr = [2, 3, 4];
        $field = "Funding Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Funding Option doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckFundingOptionExistsSuccess()
    {
        $id = 5;
        $arr = [2, 1, 4, 3, 7, 5];
        $field = "Funding Option";
        $case = ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
        $this->assertTrue($case);
    }

    public function testCheckFundingOptionExistsNull()
    {
        $id = null;
        $arr = [2, 3, 4];
        $field = "Funding Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Funding Option doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckCohortOptionExistsFailure()
    {
        $id = 9;
        $arr = [2, 3, 4];
        $field = "Cohort Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cohort Option doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckCohortOptionExistsSuccess()
    {
        $id = 7;
        $arr = [7, 3, 4];
        $field = "Cohort Option";
        $case = ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
        $this->assertTrue($case);
    }

    public function testCheckCohortOptionExistsNull()
    {
        $id = null;
        $arr = [2, 3, 4];
        $field = "Cohort Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cohort Option doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckHeardAboutOptionExistsFailure()
    {
        $id = 9;
        $arr = [2, 3, 4];
        $field = "Heard About Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Heard About Option doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }

    public function testCheckHeardAboutOptionExistsSuccess()
    {
        $id = 5;
        $arr = [2, 3, 4, 5];
        $field = "Heard About Option";
        $case = ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
        $this->assertTrue($case);
    }

    public function testCheckHeardAboutOptionExistsNull()
    {
        $id = null;
        $arr = [2, 3, 4];
        $field = "Heard About Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Heard About Option doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $arr, $field);
    }
}
