<?php

declare(strict_types=1);

namespace Portal\Models;

use PDO;
use Portal\Entities\UserEntity;
use Portal\ValueObjects\EmailAddress;

class UsersModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getByEmail(EmailAddress $email): UserEntity|false
    {
        $query = $this->db->prepare('SELECT `id`, `email`, `password` FROM `users` WHERE `email` = :email');
        $query->execute(['email' => $email]);
        $data = $query->fetch();

        if (!$data) {
            return false;
        }

        return new UserEntity(
            $data['id'],
            new EmailAddress($data['email']),
            $data['password']
        );
    }
}
