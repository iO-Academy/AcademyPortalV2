<?php

namespace Tests\Hydrators;

use Portal\Entities\User;
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
        $this->assertInstanceOf(User::class, $case);
    }

    public function testHydrateSingleMissingData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        UserHydrator::hydrateSingle([]);
    }
}
