<?php

namespace Portal\Entities;

class CourseEntity
{
    private int $id;
    private string $name;
    private string $shortName;
    private bool $remote;

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

    public function getRemote(): bool
    {
        return $this->remote;
    }
}
