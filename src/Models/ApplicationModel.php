<?php

namespace Portal\Models;

use PDO;

class ApplicationModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function addApplication($details, $applicantId)
    {
        $addApplicationQuery = $this->db->prepare('
            INSERT INTO `applications` 
                        (`applicant_id`,
                        `why`,
                        `experience`,
                        `diversitech`,
                        `circumstance_id`,
                        `funding_id`,
                        `cohort_id`,
                        `dob`,
                        `phone`,
                        `address`,
                        `heard_about_id`,
                        `age_confirmation`,
                        `newsletter`,
                        `eligible`, `terms`) 
                        VALUES 
                            (:applicant_id,
                             :why,
                             :experience,
                             :diversitech,
                             :circumstance_id,
                             :funding_id,
                             :cohort_id,
                             :dob,
                             :phone,
                             :address,
                             :heard_about_id,
                             :age_confirmation,
                             :newsletter,
                             :eligible,
                             :terms);');
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

    public function editApplication ($details)
    {
        $query = $this->db->prepare("UPDATE `applications`
        SET `why` = :why,
            `experience` = :experience,
            `diversitech` = :diversitech,
            `circumstance_id` = :circumstance_id,
            `funding_id` = :funding_id,
            `cohort_id` = :cohort_id,
            `dob` = :dob,
            `phone` = :phone,
            `address` = :address,
            `heard_about_id` = :heard_about_id,
            `age_confirmation` = :age_confirmation,
            `newsletter` = :newsletter,
            `eligible` = :eligible,
            `terms` = :terms
            WHERE `applicant_id` = :applicant_id");
        $query->execute([
            'applicant_id' => $details['id'],
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
}