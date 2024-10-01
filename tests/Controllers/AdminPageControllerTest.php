<?php

namespace Tests\Controllers;

use Portal\Controllers\AdminPageController;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class AdminPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $case = new AdminPageController($renderer);
        $this->assertInstanceOf(AdminPageController::class, $case);
    }
}
