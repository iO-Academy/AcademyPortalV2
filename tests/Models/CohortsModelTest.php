<?php

namespace Tests\Models;

use PDO;
use Portal\Models\CohortsModel;
use Tests\TestCase;

class CohortsModelTest extends TestCase
{
    public function testConstruct(): void
    {
        $db = $this->createMock(PDO::class);
        $case = new CohortsModel($db);
        $this->assertInstanceOf(CohortsModel::class, $case);
    }
}
