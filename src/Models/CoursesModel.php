<?php

namespace Portal\Models;

use PDO;
use Portal\Entities\Course;
use Portal\Hydrators\CourseHydrator;

class CoursesModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @return Course[]
     */
    public function getAll(): array
    {
        $query = $this->db->prepare("SELECT `id`, `name`, `short_name`, `remote` FROM `courses`;");
        $query->execute();

        $data = $query->fetchAll();

        $courses = [];

        foreach ($data as $course) {
            $courses[] = CourseHydrator::hydrateSingle($course);
        }

        return $courses;
    }

    public function create(string $name, string $shortName, int $remote): bool
    {
        $query = $this->db->prepare("INSERT INTO `courses` (`name`, `short_name`, `remote`) 
            VALUES (:name, :shortName, :remote);");

        return $query->execute([
            'name' => $name,
            'shortName' => $shortName,
            'remote' => $remote
        ]);
    }
}
