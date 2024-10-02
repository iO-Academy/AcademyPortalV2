<?php

namespace Portal\Entities;

class CourseEntity
{
    private int $id;
    private string $name;
    private string $shortName;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }
}
