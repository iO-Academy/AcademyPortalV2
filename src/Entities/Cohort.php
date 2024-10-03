<?php

namespace Portal\Entities;

class Cohort
{
    private int $id;
    private string $date;
    private Course $course;

    public function __construct(int $id, string $date, Course $course)
    {
        $this->id = $id;
        $this->date = $date;
        $this->course = $course;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }
}
