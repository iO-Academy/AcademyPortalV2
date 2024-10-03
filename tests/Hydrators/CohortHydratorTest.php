<?php

namespace Tests\Hydrators;

use Portal\Entities\Cohort;
use Portal\Entities\Course;
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

        $course = $this->createMock(Course::class);

        $case = CohortHydrator::hydrateSingle($data, $course);
        $this->assertInstanceOf(Cohort::class, $case);
    }

    public function testHydrateSingleInvalidData(): void
    {
        $course = $this->createMock(Course::class);
        $this->expectException(\InvalidArgumentException::class);
        CohortHydrator::hydrateSingle([], $course);
    }
}
