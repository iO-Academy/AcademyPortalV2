<?php

namespace Tests\Models;

use Portal\Models\UsersModel;
use Tests\TestCase;

class UsersModelTest extends TestCase
{
    public function testConstruct(): void
    {
        $db = $this->createMock(\PDO::class);
        $case = new UsersModel($db);
        $this->assertInstanceOf(UsersModel::class, $case);
    }
}