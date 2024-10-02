<?php

namespace Tests\Controllers;

use Portal\Controllers\CoursesPageController;
use Portal\Models\CoursesModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class CoursesPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $model = $this->createMock(CoursesModel::class);
        $authService = $this->createMock(AuthService::class);

        $case = new CoursesPageController($renderer, $model, $authService);
        $this->assertInstanceOf(CoursesPageController::class, $case);
    }
}
