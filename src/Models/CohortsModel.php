<?php

namespace Portal\Models;

use PDO;
use Portal\Entities\Cohort;
use Portal\Hydrators\CohortHydrator;
use Portal\Hydrators\CourseHydrator;

class CohortsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @return Cohort[]
     */
    public function getAll(): array
    {
        $query = $this->db->prepare("SELECT 
                                        `cohorts`.`id`,
                                        `cohorts`.`date`,
                                        `courses`.`id` AS 'courseId',
                                        `courses`.`name`,
                                        `courses`.`short_name`,
                                        `courses`.`remote`
                                        FROM `cohorts`
                                            LEFT JOIN `courses`
                                            ON `cohorts`.`course_id` = `courses`.`id`;");

        $query->execute();
        $data = $query->fetchAll();

        $cohorts = [];

        foreach ($data as $cohort) {
            $course = CourseHydrator::hydrateSingle([
                'id' => $cohort['courseId'],
                'name' => $cohort['name'],
                'short_name' => $cohort['short_name'],
                'remote' => $cohort['remote']
            ]);

            $cohorts[] = CohortHydrator::hydrateSingle([
                'id' => $cohort['id'],
                'date' => $cohort['date']
            ], $course);
        }

        return $cohorts;
    }

    public function getDate (){
        $query = $this->db->prepare("SELECT `id`, `date` FROM `cohorts`;");
        $query->execute();
        return $query->fetchAll();
    }
}
