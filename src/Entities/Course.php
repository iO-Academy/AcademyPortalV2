<?php

namespace Portal\Entities;

class Course
{
    private int $id;
    private string $name;
    private string $shortName;
    private bool $remote;

    public function __construct(int $id, string $name, string $shortName, bool $remote)
    {
        $this->id = $id;
        $this->name = $name;
        $this->shortName = $shortName;
        $this->remote = $remote;
    }

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
