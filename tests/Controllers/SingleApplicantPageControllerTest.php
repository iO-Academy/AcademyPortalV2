<?php

namespace Tests\Controllers;

use Portal\Controllers\SingleApplicantPageController;
use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class SingleApplicantPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $model = $this->createMock(ApplicantsModel::class);
        $authService = $this->createMock(AuthService::class);

        $case = new SingleApplicantPageController($renderer, $model, $authService);
        $this->assertInstanceOf(SingleApplicantPageController::class, $case);
    }
}
