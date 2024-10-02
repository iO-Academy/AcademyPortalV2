<?php

namespace Tests\Models;

use Portal\Models\ApplicantsModel;
use Tests\TestCase;

class ApplicantsModelTest extends TestCase
{
    public function testConstruct(): void
    {
        $db = $this->createMock(\PDO::class);
        $case = new ApplicantsModel($db);
        $this->assertInstanceOf(ApplicantsModel::class, $case);
    }
}