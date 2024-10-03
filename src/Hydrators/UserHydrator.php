<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\User;
use Portal\ValueObjects\EmailAddress;

class UserHydrator
{
    public static function hydrateSingle(array $data): User
    {
        self::validate($data);

        return new User(
            $data['id'],
            new EmailAddress($data['email']),
            $data['password']
        );
    }

    /**
     * Ensures the correct data is passed into the hydrator
     */
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
