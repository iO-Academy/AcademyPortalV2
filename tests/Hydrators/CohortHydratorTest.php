<?php

namespace Tests\Hydrators;

use Portal\Entities\CohortEntity;
use Portal\Entities\CourseEntity;
use Portal\Hydrators\CohortHydrator;
use Tests\TestCase;

class CohortHydratorTest extends TestCase
{
    public function testHydrateSingleValidData(): void
    {
        $data = [
            'id' => 1,
            'date' => '2024-01-01'
        ];

        $course = $this->createMock(CourseEntity::class);

        $case = CohortHydrator::hydrateSingle($data, $course);
        $this->assertInstanceOf(CohortEntity::class, $case);
    }

    public function testHydrateSingleInvalidData(): void
    {
        $course = $this->createMock(CourseEntity::class);
        $this->expectException(\InvalidArgumentException::class);
        CohortHydrator::hydrateSingle([], $course);
    }
}
