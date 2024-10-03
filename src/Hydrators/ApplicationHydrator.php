<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\Application;

class ApplicationHydrator
{
    public static function hydrateSingle(array $data): Application
    {
        self::validate($data);

        return new Application(
            $data['application_id'],
            $data['why'],
            $data['experience'],
            (bool) $data['diversitech'],
            $data['circumstance'],
            $data['funding'],
            $data['cohort'],
            $data['dob'],
            $data['phone'],
            $data['address'],
            $data['hear_about'],
            (bool) $data['age_confirmation'],
            (bool) $data['newsletter'],
            (bool) $data['eligible'],
            (bool) $data['terms']
        );
    }

    /**
     * Ensures the correct data is passed into the hydrator
     */
    private static function validate(array $data): void
    {
        $requiredFields = [
            'application_id', 'why', 'experience', 'diversitech', 'circumstance',
            'funding', 'cohort', 'dob', 'phone', 'address', 'hear_about',
            'age_confirmation', 'newsletter', 'eligible', 'terms'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }
    }
}
