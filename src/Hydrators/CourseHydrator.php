<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\Course;

class CourseHydrator
{
    public static function hydrateSingle(array $data): Course
    {
        self::validate($data);
        return new Course(
            $data['id'],
            $data['name'],
            $data['short_name'],
            $data['remote']
        );
    }

    /**
     * Ensures the correct data is passed into the hydrator
     */
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
