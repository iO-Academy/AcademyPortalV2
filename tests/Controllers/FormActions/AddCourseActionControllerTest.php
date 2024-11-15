<?php

namespace Tests\Controllers\FormActions;

use Portal\Controllers\FormActions\AddCourseActionController;
use Portal\Models\CoursesModel;
use Portal\Services\AuthService;
use Tests\TestCase;

class AddCourseActionControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $model = $this->createMock(CoursesModel::class);
        $authService = $this->createMock(AuthService::class);

        $case = new AddCourseActionController($model, $authService);
        $this->assertInstanceOf(AddCourseActionController::class, $case);
    }
}
