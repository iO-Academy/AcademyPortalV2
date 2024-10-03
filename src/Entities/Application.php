<?php

namespace Portal\Entities;

class Application
{
    private int $id;
    private string $why;
    private string $experience;
    private bool $diversitech;
    private string $circumstance;
    private string $funding;
    private string $cohort;
    private string $dob;
    private string $phone;
    private string $address;
    private string $hearAbout;
    private bool $ageConfirmation;
    private bool $newsletter;
    private bool $eligible;
    private bool $terms;

    /**
     * @param int $id
     * @param string $why
     * @param string $experience
     * @param bool $diversitech
     * @param string $circumstance
     * @param string $funding
     * @param string $cohort
     * @param string $dob
     * @param string $phone
     * @param string $address
     * @param string $hearAbout
     * @param bool $ageConfirmation
     * @param bool $newsletter
     * @param bool $eligible
     * @param bool $terms
     */
    public function __construct(
        int $id,
        string $why,
        string $experience,
        bool $diversitech,
        string $circumstance,
        string $funding,
        string $cohort,
        string $dob,
        string $phone,
        string $address,
        string $hearAbout,
        bool $ageConfirmation,
        bool $newsletter,
        bool $eligible,
        bool $terms
    ) {
        $this->id = $id;
        $this->why = $why;
        $this->experience = $experience;
        $this->diversitech = $diversitech;
        $this->circumstance = $circumstance;
        $this->funding = $funding;
        $this->cohort = $cohort;
        $this->dob = $dob;
        $this->phone = $phone;
        $this->address = $address;
        $this->hearAbout = $hearAbout;
        $this->ageConfirmation = $ageConfirmation;
        $this->newsletter = $newsletter;
        $this->eligible = $eligible;
        $this->terms = $terms;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getWhy(): string
    {
        return $this->why;
    }

    public function getExperience(): string
    {
        return $this->experience;
    }

    public function getDiversitech(): bool
    {
        return $this->diversitech;
    }

    public function getCircumstance(): string
    {
        return $this->circumstance;
    }

    public function getFunding(): string
    {
        return $this->funding;
    }

    public function getCohort(): string
    {
        return $this->cohort;
    }

    public function getDob(): string
    {
        return $this->dob;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getHearAbout(): string
    {
        return $this->hearAbout;
    }

    public function getAgeConfirmation(): bool
    {
        return $this->ageConfirmation;
    }

    public function getNewsletter(): bool
    {
        return $this->newsletter;
    }

    public function getEligible(): bool
    {
        return $this->eligible;
    }

    public function getTerms(): bool
    {
        return $this->terms;
    }
}
