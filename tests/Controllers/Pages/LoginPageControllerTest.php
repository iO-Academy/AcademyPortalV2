<?php

namespace Tests\Controllers\Pages;

use Portal\Controllers\Pages\LoginPageController;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class LoginPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $authService = $this->createMock(AuthService::class);

        $case = new LoginPageController($renderer, $authService);
        $this->assertInstanceOf(LoginPageController::class, $case);
    }
}
