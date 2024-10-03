<?php

namespace Tests\Hydrators;

use InvalidArgumentException;
use Portal\Entities\Applicant;
use Portal\Hydrators\ApplicantHydrator;
use Tests\TestCase;

class ApplicantHydratorTest extends TestCase
{
    public function testHydrateSingleValidData(): void
    {
        $data = [
            'id' => 1,
            'name' => 'Test',
            'email' => 'test@test.com',
            'application_date' => '2024-01-01'
        ];

        $case = ApplicantHydrator::hydrateSingle($data);
        $this->assertInstanceOf(Applicant::class, $case);
    }

    public function testHydrateSingleMissingData(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ApplicantHydrator::hydrateSingle([]);
    }
}
