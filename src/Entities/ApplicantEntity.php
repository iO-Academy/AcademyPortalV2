<?php

namespace Portal\Entities;

class ApplicantEntity
{
    private int $id;
    private string $name;
    private string $email;
    private string $application_date;
    private ?ApplicationEntity $application;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $application_date,
        ?ApplicationEntity $application = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->application_date = $application_date;
        $this->application = $application;
    }

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

    public function getApplication(): ?ApplicationEntity
    {
        return $this->application;
    }
}
