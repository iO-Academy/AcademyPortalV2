<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\Applicant;
use Portal\Entities\Application;
use Portal\ValueObjects\EmailAddress;

class ApplicantHydrator
{
    public static function hydrateSingle(array $data, ?Application $applicationEntity = null): Applicant
    {
        self::validate($data);

        return new Applicant(
            $data['id'],
            $data['name'],
            new EmailAddress($data['email']),
            $data['application_date'],
            $data['circumstance_id'],
            $applicationEntity
        );
    }

    /**
     * Ensures the correct data is passed into the hydrator
     */
    private static function validate(array $data): void
    {
        $requiredFields = ['id', 'name', 'email', 'application_date'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }
    }
}
