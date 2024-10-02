<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\UserEntity;
use Portal\ValueObjects\EmailAddress;

class UserHydrator
{
    public static function hydrateSingle(array $data): UserEntity
    {
        self::validate($data);

        return new UserEntity(
            $data['id'],
            new EmailAddress($data['email']),
            $data['password']
        );
    }

    private static function validate(array $data): void
    {
        $requiredFields = ['id', 'email', 'password'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }
    }
}
