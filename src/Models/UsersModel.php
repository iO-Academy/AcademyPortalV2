<?php

declare(strict_types=1);

namespace Portal\Models;

use PDO;
use Portal\Entities\User;
use Portal\Hydrators\UserHydrator;
use Portal\ValueObjects\EmailAddress;

class UsersModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getByEmail(EmailAddress $email): User|false
    {
        $query = $this->db->prepare('SELECT `id`, `email`, `password` FROM `users` WHERE `email` = :email');
        $query->execute(['email' => $email]);
        $data = $query->fetch();

        if (!$data) {
            return false;
        }

        return UserHydrator::hydrateSingle($data);
    }
}
