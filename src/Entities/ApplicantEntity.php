<?php

namespace Portal\Entities;

class ApplicantEntity
{
    private int $id;
    private string $name;
    private string $email;
    private string $application_date;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getApplicationDate(): string
    {
        return $this->application_date;
    }
}
