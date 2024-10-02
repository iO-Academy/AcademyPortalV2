<?php

namespace Tests\Hydrators;

use Portal\Entities\ApplicationEntity;
use Portal\Hydrators\ApplicationHydrator;
use Tests\TestCase;

class ApplicationHydratorTest extends TestCase
{
    public function testHydrateSingle(): void
    {
        $data = [
            'application_id' => 1,
            'why' => 'test',
            'experience' => 'test',
            'diversitech' => false,
            'circumstance' => 'School leaver',
            'funding' => 'test',
            'cohort' => '2023-01-01',
            'dob' => '1999-01-01',
            'phone' => '0123456789',
            'address' => '123 test street',
            'hear_about' => 'Google',
            'age_confirmation' => true,
            'newsletter' => true,
            'eligible' => true,
            'terms' => true,
        ];
        $case = ApplicationHydrator::hydrateSingle($data);
        $this->assertInstanceOf(ApplicationEntity::class, $case);
    }
}
