<?php

declare(strict_types=1);

namespace App\Security;

use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\Passwords;
use Nette\Security\AuthenticationException;
use App\Model\UserManager;

class Authenticator implements IAuthenticator
{
    private UserManager $userManager;
    private Passwords $passwords;

    public function __construct(UserManager $userManager, Passwords $passwords)
    {
        $this->userManager = $userManager;
        $this->passwords = $passwords;
    }

    public function authenticate(array $credentials): Identity
    {
        [$username, $password] = $credentials;
        $user = $this->userManager->findByUsername($username);

        if (!$user) {
            throw new AuthenticationException('اسم المستخدم غير موجود.');
        }

        if (!$this->passwords === $user->password) {
            throw new AuthenticationException('كلمة المرور غير صحيحة.');
        }

        return new Identity($user->id, null, ['username' => $user->username]);

    }
}
