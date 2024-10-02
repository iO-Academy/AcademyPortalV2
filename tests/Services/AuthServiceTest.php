<?php

namespace Tests\Services;

use Portal\Entities\UserEntity;
use Portal\Models\UsersModel;
use Portal\Services\AuthService;
use Portal\ValueObjects\EmailAddress;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function testAuthenticateValidPassword(): void
    {
        // Hash for 'password'
        $passwordHash = '$2y$10$PGScoCmMR59xgFuu8XLqmegAy8PYl/FnahG2yWp3qTgoLutzsMJFa';
        $user = $this->createMock(UserEntity::class);
        $user->method('getPassword')->willReturn($passwordHash);

        $usersModel = $this->createMock(UsersModel::class);
        $usersModel->method('getByEmail')->willReturn($user);

        $authService = new AuthService($usersModel);
        $case = $authService->authenticate(new EmailAddress('test@test.com'), 'password');
        $this->assertInstanceOf(UserEntity::class, $case);
    }

    public function testAuthenticateInvalidPassword(): void
    {
        // Hash for 'password'
        $passwordHash = '$2y$10$PGScoCmMR59xgFuu8XLqmegAy8PYl/FnahG2yWp3qTgoLutzsMJFa';
        $user = $this->createMock(UserEntity::class);
        $user->method('getPassword')->willReturn($passwordHash);

        $usersModel = $this->createMock(UsersModel::class);
        $usersModel->method('getByEmail')->willReturn($user);

        $authService = new AuthService($usersModel);
        $case = $authService->authenticate(new EmailAddress('test@test.com'), 'test');
        $this->assertNull($case);
    }

    public function testAuthenticateUserNotFound(): void
    {
        $usersModel = $this->createMock(UsersModel::class);
        $usersModel->method('getByEmail')->willReturn(false);

        $authService = new AuthService($usersModel);
        $case = $authService->authenticate(new EmailAddress('test@test.com'), 'test');
        $this->assertNull($case);
    }
}
