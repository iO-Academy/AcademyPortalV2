<?php

namespace Tests\Controllers\Pages;

use Portal\Controllers\Pages\AdminPageController;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class AdminPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $authService = $this->createMock(AuthService::class);
        $case = new AdminPageController($renderer, $authService);
        $this->assertInstanceOf(AdminPageController::class, $case);
    }
}
