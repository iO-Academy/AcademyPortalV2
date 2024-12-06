<?php

namespace Portal\Models;

use PDO;
use Portal\Entities\Applicant;
use Portal\Hydrators\ApplicantHydrator;
use Portal\Hydrators\ApplicationHydrator;

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

        $query = $this->db->prepare('SELECT `id`, `name`, `email`, `application_date`, `archived` 
                                            FROM `applicants` 
                                            WHERE `archived` = 0
                                            LIMIT ' . (int)$start . ', ' . (int)$perPage);
        $query->execute();

        $data = $query->fetchAll();

        $applicants = [];

        foreach ($data as $applicant) {
            $applicants[] = ApplicantHydrator::hydrateSingle($applicant);
        }

        return $applicants;
    }

    public function getCount(): int
    {
        $query = $this->db->prepare("SELECT COUNT(*) AS 'count' FROM `applicants`;");
        $query->execute();
        return $query->fetch()['count'];
    }

    public function getById(int $id): Applicant|false
    {
        $query = $this->db->prepare("SELECT 
                                            `applicants`.`id`,
                                            `applicants`.`name`, 
                                            `applicants`.`email`, 
                                            `applicants`.`application_date`,
                                            `applications`.`id` AS 'application_id',
                                            `applications`.`why`,
                                            `applications`.`experience`,
                                            `applications`.`diversitech`,
                                            `applications`.`dob`,
                                            `applications`.`phone`,
                                            `applications`.`address`,
                                            `applications`.`age_confirmation`,
                                            `applications`.`newsletter`,
                                            `applications`.`eligible`,
                                            `applications`.`terms`,
                                            `applications`.`circumstance_id`,
                                            `circumstances`.`option` AS 'circumstance',
                                            `funding_options`.`option` AS 'funding',
                                            `cohorts`.`date` AS 'cohort',
                                            `hear_about`.`option` AS 'hear_about'
                                            FROM `applicants`
                                            LEFT JOIN `applications`
                                                ON `applicants`.`id` = `applications`.`applicant_id`
                                            LEFT JOIN `circumstances`
                                                ON `applications`.`circumstance_id` = `circumstances`.`id`
                                            LEFT JOIN `funding_options`
                                                ON `applications`.`funding_id` = `funding_options`.`id`
                                            LEFT JOIN `cohorts`
                                                ON `applications`.`cohort_id` = `cohorts`.`id`
                                            LEFT JOIN `hear_about`
                                                ON `applications`.`heard_about_id` = `hear_about`.`id`
                                            WHERE `applicants`.`id` = :id;
                                            ");
        $query->execute(['id' => $id]);

        $data = $query->fetch();

        if (!$data) {
            return false;
        }

        // Handle an applicant without any application form data
        if (!$data['application_id']) {
            return ApplicantHydrator::hydrateSingle($data);
        }

        $applicationEntity = ApplicationHydrator::hydrateSingle($data);

        return ApplicantHydrator::hydrateSingle($data, $applicationEntity);
    }

    public function editApplicant($details)
    {
        $query1 = $this->db->prepare("UPDATE `applicants` SET `name` = :name, `email` = :email WHERE `id` = :id;");
        $query1->execute([
            'id' => $details['id'],
            'name' => $details['name'],
            'email' => $details['email']
        ]);
    }

    public function addApplicant($data)
    {
        $addApplicantQuery = $this->db->prepare('INSERT INTO `applicants` 
            (`name`, `email`, `application_date`) VALUES (:name, :email, current_date)');
        $addApplicantQuery->execute([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $lastInsertId = $this->db->lastInsertId();
        return $lastInsertId;
    }

    public function getAllCircumstanceOptions()
    {
        $query = $this->db->prepare('SELECT `id`, `option` FROM `circumstances`');
        $query->execute();
        $data = $query->fetchAll();

        if (!$data) {
            return false;
        } else {
            return $data;
        }
    }

    public function getAllFundingOptions()
    {
        $query = $this->db->prepare('SELECT `id`, `option` FROM `funding_options`');
        $query->execute();
        $data = $query->fetchAll();

        if (!$data) {
            return false;
        } else {
            return $data;
        }
    }

    public function getAllHearAboutUsOptions()
    {
        $query = $this->db->prepare('SELECT `id`, `option` FROM `hear_about`');
        $query->execute();
        $data = $query->fetchAll();

        if (!$data) {
            return false;
        } else {
            return $data;
        }
    }

    public function archiveApplicant(int $applicantId)
    {
        $query = $this->db->prepare('UPDATE `applicants` SET `archived` = 1 WHERE `id` = :id');
        $query->execute(['id' => $applicantId]);
    }
}
