<?php

namespace Tests\Controllers\Pages;

use Portal\Controllers\Pages\AddCoursePageController;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class AddCoursePageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $authService = $this->createMock(AuthService::class);

        $case = new AddCoursePageController($renderer, $authService);
        $this->assertInstanceOf(AddCoursePageController::class, $case);
    }
}
