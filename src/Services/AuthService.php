<?php

namespace Portal\Services;

use Portal\Entities\UserEntity;
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
        return $this->sessionManager->get('loggedIn') === true;
    }

    public function login(UserEntity $user): void
    {
        $this->sessionManager->set('loggedIn', true);
        $this->sessionManager->set('uid', $user->getId());
    }
}
