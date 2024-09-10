<?php
 
declare(strict_types=1);
 
namespace App\UI\Sign;

use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\Application\UI\Presenter;
use App\Security\Authenticator;
use Nette\Security\AuthenticationException;


class SignPresenter extends Presenter
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->addText('username', 'اسم المستخدم:')
            ->setRequired('الرجاء إدخال اسم المستخدم.');
        $form->addPassword('password', 'كلمة المرور:')
            ->setRequired('الرجاء إدخال كلمة المرور.');
        $form->addSubmit('send', 'تسجيل الدخول');
        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }

    public function signInFormSucceeded(Form $form, \stdClass $values): void
    {
        try {
            $this->user->login($values->username, $values->password);
            $this->redirect('Homepage:');
        } catch (\Nette\Security\AuthenticationException $e) {
            $form->addError('اسم المستخدم أو كلمة المرور غير صحيحة.');
        }
    }

    public function actionOut(): void
    {
        $this->getUser()->logout();
        $this->redirect('Sign:SignIn');
    }
}

 


  