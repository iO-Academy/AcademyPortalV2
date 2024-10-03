<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\Cohort;
use Portal\Entities\Course;

class CohortHydrator
{
    public static function hydrateSingle(array $data, Course $courseEntity): Cohort
    {
        self::validate($data);

        return new Cohort(
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
