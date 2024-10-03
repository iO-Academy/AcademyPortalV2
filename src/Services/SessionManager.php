<?php

namespace Portal\Services;

/**
 * A simple class to manage sessions. Using this vs $_SESSION allows you to mock sessions in unit tests.
 * The AuthServiceTest is a good example of this in action.
 */
class SessionManager
{
    /**
     * Store a value in the session. Starts the session automatically if needed.
     */
    public function set(string $key, mixed $value): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve a value from the session. Starts the session automatically if needed.
     *
     * @return mixed The value stored in session or null if it doesn't exist
     */
    public function get(string $key): mixed
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return $_SESSION[$key] ?? null;
    }
}
