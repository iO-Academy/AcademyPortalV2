<?php

namespace Tests\Controllers;

use Portal\Controllers\LoginActionController;
use Portal\Models\UsersModel;
use Tests\TestCase;

class LoginActionControllerTest extends TestCase
{
    public function testConstruct(): void
    {
        $model = $this->createMock(UsersModel::class);
        $case = new LoginActionController($model);
        $this->assertInstanceOf(LoginActionController::class, $case);
    }
}
