<?php

namespace Tests\Controllers;

use Portal\Controllers\ApplicantsPageController;
use Portal\Models\ApplicantsModel;
use Slim\Views\PhpRenderer;
use Tests\TestCase;

class ApplicantsPageControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $renderer = $this->createMock(PhpRenderer::class);
        $model = $this->createMock(ApplicantsModel::class);
        $case = new ApplicantsPageController($renderer, $model);
        $this->assertInstanceOf(ApplicantsPageController::class, $case);
    }
}
