<?php

namespace Tests\Services;

use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;
use Portal\Services\ValidationService;
use PHPUnit\Framework\TestCase;

class ValidationServiceTest extends TestCase
{
    public function testCheckCircumstanceOptionExistsFailure()
    {
        $id = 1;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllCircumstanceOptions')->willReturn([]);
        $field = "Circumstance";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Circumstance doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $model, $field);
    }

    public function testCheckCircumstanceOptionExistsSuccess()
    {
        $id = '1';
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllCircumstanceOptions')->willReturn([['id' => 1]]);
        $field = "Circumstance";
        $case = ValidationService::checkCircumstanceOptionExists($id, $model, $field);
        $this->assertTrue($case);
    }

    public function testCheckCircumstanceOptionExistsNull()
    {
        $id = null;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllCircumstanceOptions')->willReturn([]);
        $field = "Circumstance";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Circumstance doesn't exist");
        ValidationService::checkCircumstanceOptionExists($id, $model, $field);
    }

    public function testCheckFundingOptionExistsFailure()
    {
        $id = 1;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllFundingOptions')->willReturn([]);
        $field = "Funding Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Funding Option doesn't exist");
        ValidationService::checkFundingOptionExists($id, $model, $field);
    }

    public function testCheckFundingOptionExistsSuccess()
    {
        $id = 5;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllFundingOptions')->willReturn([['id' => 5]]);
        $field = "Funding Option";
        $case = ValidationService::checkFundingOptionExists($id, $model, $field);
        $this->assertTrue($case);
    }

    public function testCheckFundingOptionExistsNull()
    {
        $id = null;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllFundingOptions')->willReturn([]);
        $field = "Funding Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Funding Option doesn't exist");
        ValidationService::checkFundingOptionExists($id, $model, $field);
    }

    public function testCheckCohortOptionExistsFailure()
    {
        $id = 9;
        $model = $this->createMock(CohortsModel::class);
        $model->method('getAll')->willReturn([['id' => 9]]);
        $field = "Cohort Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cohort Option doesn't exist");
        ValidationService::checkCohortOptionExists($id, $model, $field);
    }

    public function testCheckCohortOptionExistsSuccess()
    {
        $id = 7;
        $model = $this->createMock(CohortsModel::class);
        $model->method('getAll')->willReturn([['id' => 7]]);
        $field = "Cohort Option";
        $case = ValidationService::checkCohortOptionExists($id, $model, $field);
        $this->assertTrue($case);
    }

    public function testCheckCohortOptionExistsNull()
    {
        $id = null;
        $model = $this->createMock(CohortsModel::class);
        $model->method('getAll')->willReturn([]);
        $field = "Cohort Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cohort Option doesn't exist");
        ValidationService::checkCohortOptionExists($id, $model, $field);
    }

    public function testCheckHeardAboutOptionExistsFailure()
    {
        $id = 9;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllHearAboutUsOptions')->willReturn([]);
        $field = "Heard About Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Heard About Option doesn't exist");
        ValidationService::checkHeardAboutOptionExists($id, $model, $field);
    }

    public function testCheckHeardAboutOptionExistsSuccess()
    {
        $id = 5;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllHearAboutUsOptions')->willReturn([['id' => 5]]);
        $field = "Heard About Option";
        $case = ValidationService::checkHeardAboutOptionExists($id, $model, $field);
        $this->assertTrue($case);
    }

    public function testCheckHeardAboutOptionExistsNull()
    {
        $id = null;
        $model = $this->createMock(ApplicantsModel::class);
        $model->method('getAllHearAboutUsOptions')->willReturn([]);
        $field = "Heard About Option";
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Heard About Option doesn't exist");
        ValidationService::checkHeardAboutOptionExists($id, $model, $field);
    }
}
