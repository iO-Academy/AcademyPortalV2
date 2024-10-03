<?php

namespace Portal\Services;

use Portal\Entities\User;
use Portal\Models\UsersModel;
use Portal\ValueObjects\EmailAddress;

class AuthService
{
    private UsersModel $usersModel;
    private SessionManager $sessionManager;

    public function __construct(UsersModel $usersModel, SessionManager $sessionManager)
    {
        $this->usersModel = $usersModel;
        $this->sessionManager = $sessionManager;
    }

    public function authenticate(EmailAddress $email, string $password): ?User
    {
        $user = $this->usersModel->getByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

    public function isLoggedIn(): bool
    {
        return $this->sessionManager->get('loggedIn') === true;
    }

    public function login(User $user): void
    {
        $this->sessionManager->set('loggedIn', true);
        $this->sessionManager->set('uid', $user->getId());
    }
}
