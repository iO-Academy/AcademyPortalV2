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

    public function getAll(int $page = 1): array
    {
        $perPage = 20;
        $start = ($page - 1) * $perPage;

        $query = $this->db->prepare('SELECT `id`, `name`, `email`, `application_date` 
                                            FROM `applicants` 
                                            LIMIT ' . (int)$start . ', ' . (int)$perPage);
        $query->setFetchMode(PDO::FETCH_CLASS, ApplicantEntity::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function getCount(): int
    {
        $query = $this->db->prepare("SELECT COUNT(*) AS 'count' FROM `applicants`;");
        $query->execute();
        return $query->fetch()['count'];
    }
}
