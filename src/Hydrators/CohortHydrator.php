<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\CohortEntity;
use Portal\Entities\CourseEntity;

class CohortHydrator
{
    public static function hydrateSingle(array $data, CourseEntity $courseEntity): CohortEntity
    {
        self::validate($data);

        return new CohortEntity(
            $data['id'],
            $data['date'],
            $courseEntity
        );
    }

    /**
     * Ensures the correct data is passed into the hydrator
     */
    private static function validate(array $data): void
    {
        $requiredFields = ['id', 'date'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }
    }
}
