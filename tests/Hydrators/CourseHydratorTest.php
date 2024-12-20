<?php

namespace Tests\Hydrators;

use Portal\Entities\Course;
use Portal\Hydrators\CourseHydrator;
use Tests\TestCase;

class CourseHydratorTest extends TestCase
{
    public function testHydrateSingleValidData(): void
    {
        $data = [
            'id' => 1,
            'name' => 'Test',
            'short_name' => 'T',
            'remote' => true
        ];

        $case = CourseHydrator::hydrateSingle($data);
        $this->assertInstanceOf(Course::class, $case);
    }

    public function testHydrateSingleInvalidData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        CourseHydrator::hydrateSingle([]);
    }
}
