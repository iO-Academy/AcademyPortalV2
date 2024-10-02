<?php

namespace Tests\Controllers;

use Portal\Controllers\CohortsPageController;
use Portal\Models\CohortsModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class CohortsPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $model = $this->createMock(CohortsModel::class);
        $authService = $this->createMock(AuthService::class);

        $case = new CohortsPageController($renderer, $model, $authService);
        $this->assertInstanceOf(CohortsPageController::class, $case);
    }
}
