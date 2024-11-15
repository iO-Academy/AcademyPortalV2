<?php

namespace Tests\Controllers\Pages;

use Portal\Controllers\Pages\ApplicantsPageController;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class ApplicantsPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $model = $this->createMock(ApplicantsModel::class);
        $authService = $this->createMock(AuthService::class);

        $case = new ApplicantsPageController($renderer, $model, $authService);
        $this->assertInstanceOf(ApplicantsPageController::class, $case);
    }
}
