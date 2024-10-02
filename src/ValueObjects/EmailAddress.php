<?php

namespace Portal\ValueObjects;

use Exception;

class EmailAddress
{
    private string $email;

    /**
     * @throws Exception
     */
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address');
        }
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
