<?php

namespace Portal\Hydrators;

use Portal\Entities\UserEntity;
use Portal\ValueObjects\EmailAddress;

class UserHydrator
{
    public static function hydrateSingle(array $data): UserEntity
    {
        return new UserEntity(
            $data['id'],
            new EmailAddress($data['email']),
            $data['password']
        );
    }
}