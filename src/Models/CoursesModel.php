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
}
