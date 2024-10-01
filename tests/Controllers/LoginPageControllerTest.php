<?php

namespace Tests\Controllers;

use Portal\Controllers\LoginPageController;
use Portal\Models\UsersModel;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class LoginPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $case = new LoginPageController($renderer);
        $this->assertInstanceOf(LoginPageController::class, $case);
    }
}
