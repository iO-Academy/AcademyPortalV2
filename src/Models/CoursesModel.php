<?php

namespace Portal\Models;

use PDO;
use Portal\Entities\CourseEntity;

class CoursesModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @return CourseEntity[]
     */
    public function getAll(): array
    {
        $query = $this->db->prepare("SELECT `id`, `name`, `short_name` AS 'shortName', `remote` FROM `courses`;");
        $query->setFetchMode(PDO::FETCH_CLASS, CourseEntity::class);
        $query->execute();

        return $query->fetchAll();
    }
}
