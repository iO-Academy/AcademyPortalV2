<?php

namespace Portal\Services;

class AuthService
{
    public static function isLoggedIn(): bool
    {
        self::startSession();

        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            return true;
        }

        return false;
    }

    public static function login(): void
    {
        self::startSession();

        $_SESSION['loggedIn'] = true;
    }

    private static function startSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
