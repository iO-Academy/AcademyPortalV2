<?php

namespace Portal\Entities;

use Portal\ValueObjects\EmailAddress;

class Applicant
{
    private int $id;
    private string $name;
    private EmailAddress $email;
    private string $application_date;
    private ?Application $application;
    private int $circumstance_id;

    public function __construct(
        int          $id,
        string       $name,
        EmailAddress $email,
        string       $application_date,
        int $circumstance_id,
        ?Application $application = null

    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->application_date = $application_date;
        $this->application = $application;
        $this->circumstance_id = $circumstance_id;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getApplicationDate(): string
    {
        return $this->application_date;
    }

    public function getFormattedApplicationDate(): string
    {
        return date("jS F, Y", strtotime($this->application_date));
    }

    public function getCircumstanceId(): int
    {
        return $this->circumstance_id;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }


}
