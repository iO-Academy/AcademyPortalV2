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

        $query = $this->db->prepare('SELECT `id`, `name`, `email`, `application_date` 
                                            FROM `applicants` 
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

    public function getCircumstanceID()
    {
        $query = $this->db->prepare("SELECT `circumstance_id` FROM `applications`;");
        $query->execute();
        return $query->fetch();
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

    public function editApplicant($details){
        $query1 = $this->db->prepare("UPDATE `applicants` SET `name` = :name, `email` = :email WHERE `id` = :id;");
        $query1->execute([
            'id' => $details['id'],
            'name' => $details['name'],
            'email' => $details['email']
        ]);

        $query2 = $this->db->prepare("UPDATE `applications`
        SET `why` = :why,
            `experience` = :experience,
            `diversitech` = :diversitech,
            `cohort_id` = :cohort_id,
            `phone` = :phone,
            `heard_about_id` = :heard_about_id,
            `eligible` = :eligible
            WHERE `applicant_id` = :id");

        $query2->execute([
            'id' => $details['id'],
            'why' => !empty($details['why']) ? $details['why'] : null,
            'experience' => !empty($details['experience']) ? $details['experience'] : null,
            'diversitech' => !empty($details['diversitech']) ? $details['diversitech'] : null,
            'cohort_id' => !empty($details['cohort_id']) ? $details['cohort_id'] : null,
            'phone' => !empty($details['phone']) ? $details['phone'] : null,
            'heard_about_id' => !empty($details['heard_about_id']) ? $details['heard_about_id'] : null,
            'eligible' => !empty($details['eligible']) ? $details['eligible'] : null
        ]);

//        $query2 = $this->db->prepare("UPDATE `applications`
//        SET `why` = :why,
//            `experience` = :experience,
//            `diversitech` = :diversitech,
//            `circumstance_id` = :circumstances_id,
//            `funding_id` = :funding_id,
//            `cohort_id` = :cohort_id,
//            `dob` = :dob,
//            `phone` = :phone,
//            `address` = :address,
//            `heard_about_id` = :heard_about_id,
//            `age_confirmation` = :age_confirmation,
//            `newsletter` = :newsletter,
//            `eligible` = :eligible,
//            `terms` = :terms
//            WHERE `applicant_id` = :id");
//
//        $query2->execute([
//            'applicant_id' => $details['id'],
//            'why' => !empty($details['why']) ? $details['why'] : null,
//            'experience' => !empty($details['experience']) ? $details['experience'] : null,
//            'diversitech' => !empty($details['diversitech']) ? $details['diversitech'] : null,
//            'circumstance_id' => !empty($details['circumstance_id']) ? $details['circumstance_id'] : null,
//            'funding_id' => !empty($details['funding_id']) ? $details['funding_id'] : null,
//            'cohort_id' => !empty($details['cohort_id']) ? $details['cohort_id'] : null,
//            'dob' => !empty($details['dob']) ? $details['dob'] : null,
//            'phone' => !empty($details['phone']) ? $details['phone'] : null,
//            'address' => !empty($details['address']) ? $details['address'] : null,
//            'heard_about_id' => !empty($details['heard_about_id']) ? $details['heard_about_id'] : null,
//            'age_confirmation' => !empty($details['age_confirmation']) ? $details['age_confirmation'] : null,
//            'newsletter' => !empty($details['newsletter']) ? $details['newsletter'] : null,
//            'eligible' => !empty($details['eligible']) ? $details['eligible'] : null,
//            'terms' => !empty($details['terms']) ? $details['terms'] : null
//        ]);
    }

    public function addApplicant($data)
    {
        $addApplicantQuery = $this->db->prepare('INSERT INTO `applicants` (`name`, `email`, `application_date`) VALUES (:name, :email, current_date)');
            $addApplicantQuery->execute([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
            $lastInsertId = $this->db->lastInsertId();
            return $lastInsertId;
    }

    public function addApplication($details, $applicantId)
    {
        $addApplicationQuery = $this->db->prepare("INSERT INTO `applications` (`applicant_id`, `why`, `experience`, `diversitech`, `circumstance_id`, `funding_id`, `cohort_id`, `dob`, `phone`, `address`, `heard_about_id`, `age_confirmation`, `newsletter`, `eligible`, `terms`) 
                VALUES (:applicant_id, :why, :experience, :diversitech, :circumstance_id, :funding_id, :cohort_id, :dob, :phone, :address, :heard_about_id, :age_confirmation, :newsletter, :eligible, :terms);");
        return $addApplicationQuery->execute([
            'applicant_id' => $applicantId,
            'why' => $details['why'],
            'experience' => $details['experience'],
            'diversitech' => $details['diversitech'],
            'circumstance_id' => $details['circumstance_id'],
            'funding_id' => $details['funding_id'],
            'cohort_id' => $details['cohort_id'],
            'dob' => $details['dob'],
            'phone' => $details['phone'],
            'address' => $details['address'],
            'heard_about_id' => $details['heard_about_id'],
            'age_confirmation' => $details['age_confirmation'],
            'newsletter' => $details['newsletter'],
            'eligible' => $details['eligible'],
            'terms' => $details['terms']
        ]);
    }

    public function getAllCircumstances()
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


    public function getAllCohorts()
    {
        $query = $this->db->prepare('SELECT `id`, `date` FROM `cohorts`');
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

    public function getAllHearAboutUs()
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
}
