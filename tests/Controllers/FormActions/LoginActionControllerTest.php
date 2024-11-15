<?php

namespace Tests\Controllers\FormActions;

use Portal\Controllers\FormActions\LoginActionController;
use Portal\Models\UsersModel;
use Portal\Services\AuthService;
use Tests\TestCase;

class LoginActionControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $model = $this->createMock(UsersModel::class);
        $authService = $this->createMock(AuthService::class);

        $case = new LoginActionController($model, $authService);
        $this->assertInstanceOf(LoginActionController::class, $case);
    }
}
