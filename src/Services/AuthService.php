<?php

namespace Portal\Services;

use Portal\Entities\UserEntity;
use Portal\Models\UsersModel;
use Portal\ValueObjects\EmailAddress;

class AuthService
{
    private UsersModel $usersModel;

    public function __construct(UsersModel $usersModel)
    {
        $this->usersModel = $usersModel;
    }

    public function authenticate(EmailAddress $email, string $password): ?UserEntity
    {
        $user = $this->usersModel->getByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

    public function isLoggedIn(): bool
    {
        $this->startSession();

        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            return true;
        }

        return false;
    }

    public function login(UserEntity $user): void
    {
        $this->startSession();

        $_SESSION['loggedIn'] = true;
        $_SESSION['uid'] = $user->getId();
    }

    private function startSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
