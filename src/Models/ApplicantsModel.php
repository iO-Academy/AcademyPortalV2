<?php

namespace Portal\Models;

use PDO;
use Portal\Entities\ApplicantEntity;

class ApplicantsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $query = $this->db->prepare('SELECT `id`, `name`, `email`, `application_date` FROM `applicants`');
        $query->setFetchMode(PDO::FETCH_CLASS, ApplicantEntity::class);
        $query->execute();
        return $query->fetchAll();
    }
}