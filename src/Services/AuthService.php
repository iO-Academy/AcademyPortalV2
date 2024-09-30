<?php

namespace Portal\Services;

class AuthService
{
    public static function isLoggedIn(): bool
    {
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            return true;
        }

        return false;
    }

    public static function login(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['loggedIn'] = true;
    }

}