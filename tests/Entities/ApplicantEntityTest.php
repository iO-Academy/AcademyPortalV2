<?php

namespace Tests\Entities;

use Portal\Entities\ApplicantEntity;
use Tests\TestCase;

class ApplicantEntityTest extends TestCase
{
    public function testConstruct(): void
    {
        $case = new ApplicantEntity(1, 'test', 'test@test.com', '2024-01-01');
        $this->assertInstanceOf(ApplicantEntity::class, $case);
    }

    public function testGetFormattedApplicationDate(): void
    {
        $entity = new ApplicantEntity(1, 'test', 'test@test.com', '2024-01-01');
        $expected = '1st January, 2024';
        $actual = $entity->getFormattedApplicationDate();
        $this->assertEquals($expected, $actual);
    }
}
