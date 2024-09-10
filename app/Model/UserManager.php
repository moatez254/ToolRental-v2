<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Security\Passwords;

class UserManager
{
    private Explorer $database;
    private Passwords $passwords;

    public function __construct(Explorer $database, Passwords $passwords)
    {
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function findByUsername(string $username)
    {
        return $this->database->table('users')
            ->where('username', $username)
            ->fetch();
    }

    public function authenticate(string $username, string $password)
    {
        $user = $this->database->table('users')->where('username', $username)->fetch();

        if (!$user || !$this->passwords->verify($password, $user->password)) {
            throw new \Nette\Security\AuthenticationException('Invalid username or password.');
        }

        return $user;
    }
}
