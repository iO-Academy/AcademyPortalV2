<?php

namespace Tests\Models;

use PDO;
use Portal\Models\CoursesModel;
use Tests\TestCase;

class CoursesModelTest extends TestCase
{
    public function testConstruct(): void
    {
        $db = $this->createMock(PDO::class);
        $case = new CoursesModel($db);
        $this->assertInstanceOf(CoursesModel::class, $case);
    }
}
