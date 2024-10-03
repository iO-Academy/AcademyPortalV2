<?php

namespace Tests\Services;

use Portal\Entities\User;
use Portal\Models\UsersModel;
use Portal\Services\AuthService;
use Portal\Services\SessionManager;
use Portal\ValueObjects\EmailAddress;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function testAuthenticateValidPassword(): void
    {
        // Hash for 'password'
        $passwordHash = '$2y$10$PGScoCmMR59xgFuu8XLqmegAy8PYl/FnahG2yWp3qTgoLutzsMJFa';
        $user = $this->createMock(User::class);
        $user->method('getPassword')->willReturn($passwordHash);

        $usersModel = $this->createMock(UsersModel::class);
        $usersModel->method('getByEmail')->willReturn($user);

        $sessionManager = $this->createMock(SessionManager::class);

        $authService = new AuthService($usersModel, $sessionManager);
        $case = $authService->authenticate(new EmailAddress('test@test.com'), 'password');
        $this->assertInstanceOf(User::class, $case);
    }

    public function testAuthenticateInvalidPassword(): void
    {
        // Hash for 'password'
        $passwordHash = '$2y$10$PGScoCmMR59xgFuu8XLqmegAy8PYl/FnahG2yWp3qTgoLutzsMJFa';
        $user = $this->createMock(User::class);
        $user->method('getPassword')->willReturn($passwordHash);

        $usersModel = $this->createMock(UsersModel::class);
        $usersModel->method('getByEmail')->willReturn($user);

        $sessionManager = $this->createMock(SessionManager::class);

        $authService = new AuthService($usersModel, $sessionManager);
        $case = $authService->authenticate(new EmailAddress('test@test.com'), 'test');
        $this->assertNull($case);
    }

    public function testAuthenticateUserNotFound(): void
    {
        $usersModel = $this->createMock(UsersModel::class);
        $usersModel->method('getByEmail')->willReturn(false);

        $sessionManager = $this->createMock(SessionManager::class);

        $authService = new AuthService($usersModel, $sessionManager);
        $case = $authService->authenticate(new EmailAddress('test@test.com'), 'test');
        $this->assertNull($case);
    }

    public function testIsLoggedInWhenLoggedIn(): void
    {
        $usersModel = $this->createMock(UsersModel::class);
        $sessionManager = $this->createMock(SessionManager::class);
        $sessionManager->method('get')->willReturn(true);

        $authService = new AuthService($usersModel, $sessionManager);
        $case = $authService->isLoggedIn();
        $this->assertTrue($case);
    }

    public function testIsLoggedInWhenLoggedOut(): void
    {
        $usersModel = $this->createMock(UsersModel::class);
        $sessionManager = $this->createMock(SessionManager::class);
        $sessionManager->method('get')->willReturn(false);

        $authService = new AuthService($usersModel, $sessionManager);
        $case = $authService->isLoggedIn();
        $this->assertFalse($case);
    }

    public function testLoginSetsSessionVariables(): void
    {
        $user = $this->createMock(User::class);
        $user->method('getId')->willReturn(1);

        $usersModel = $this->createMock(UsersModel::class);
        $sessionManager = $this->createMock(SessionManager::class);
        $sessionManager->expects($this->exactly(2))->method('set');

        $authService = new AuthService($usersModel, $sessionManager);
        $authService->login($user);
    }
}
