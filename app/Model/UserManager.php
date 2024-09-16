<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Security\SimpleIdentity;
use Nette\Security\Passwords;

final class UserManager implements Nette\Security\Authenticator
{
    use Nette\SmartObject;

    private Nette\Database\Explorer $database;
    private Passwords $passwords;

    public function __construct(Nette\Database\Explorer $database, Passwords $passwords)
    {
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $row = $this->database->table('users')
            ->where('username', $username)
            ->fetch();

        if (!$row) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->password)) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $row->id,
            $row->role,
            ['username' => $row->username]
        );
    }
}
