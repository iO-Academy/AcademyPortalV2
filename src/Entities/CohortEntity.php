<?php

namespace Portal\Entities;

class CohortEntity
{
    private int $id;
    private string $date;
    private CourseEntity $course;

    public function __construct(int $id, string $date, CourseEntity $course)
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

    public function getCourse(): CourseEntity
    {
        return $this->course;
    }
}
