<?php

namespace Portal\Hydrators;

use Portal\Entities\ApplicationEntity;

class ApplicationHydrator
{
    public static function hydrateSingle(array $data): ApplicationEntity
    {
        return new ApplicationEntity(
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
}
