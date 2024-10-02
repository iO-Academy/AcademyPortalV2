<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\CourseEntity;

class CourseHydrator
{
    public static function hydrateSingle(array $data): CourseEntity
    {
        self::validate($data);
        return new CourseEntity(
            $data['id'],
            $data['name'],
            $data['short_name'],
            $data['remote']
        );
    }

    private static function validate(array $data): void
    {
        $requiredFields = ['id', 'name', 'short_name', 'remote'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }
    }
}
