<?php

namespace Tests\Hydrators;

use Portal\Entities\UserEntity;
use Portal\Hydrators\UserHydrator;
use Tests\TestCase;

class UserHydratorTest extends TestCase
{
    public function testHydrateSingle(): void
    {
        $data = [
            'id' => 1,
            'email' => 'test@test.com',
            'password' => 'password'
        ];

        $case = UserHydrator::hydrateSingle($data);
        $this->assertInstanceOf(UserEntity::class, $case);
    }
}