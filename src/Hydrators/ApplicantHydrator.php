<?php

namespace Portal\Hydrators;

use InvalidArgumentException;
use Portal\Entities\ApplicantEntity;
use Portal\Entities\ApplicationEntity;
use Portal\ValueObjects\EmailAddress;

class ApplicantHydrator
{
    public static function hydrateSingle(array $data, ?ApplicationEntity $applicationEntity = null): ApplicantEntity
    {
        self::validate($data);

        return new ApplicantEntity(
            $data['id'],
            $data['name'],
            new EmailAddress($data['email']),
            $data['application_date'],
            $applicationEntity
        );
    }

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
