<?php

namespace Portal\Entities;

use Portal\ValueObjects\EmailAddress;

class User
{
    private int $id;
    private EmailAddress $email;
    private string $password;

    public function __construct(int $id, EmailAddress $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
