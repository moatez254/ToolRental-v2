<?php
 
declare(strict_types=1);
 
namespace App\UI\Sign;
 
use Nette;
use Nette\Application\UI\Form;

final class SignPresenter extends Nette\Application\UI\Presenter
 
{
    private Nette\Security\User $user;

    public function __construct(Nette\Security\User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    protected function createComponentSignInForm(): Form
    {
        $form = new Form;

        $form->addText('username', 'Username:')
            ->setRequired('Please enter your username.');

        $form->addPassword('password', 'Password:')
            ->setRequired('Please enter your password.');

        $form->addCheckbox('remember', 'Keep me signed in');

        $form->addSubmit('send', 'Sign in');

        $form->onSuccess[] = [$this, 'signInFormSucceeded'];

        return $form;
    }

    public function signInFormSucceeded(Form $form, \stdClass $values): void
    {
        try {
            $this->user->setExpiration($values->remember ? '14 days' : '20 minutes');
            $this->user->login($values->username, $values->password);
            $this->redirect('Homepage:default');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Invalid credentials.');
        }
    }

    public function actionOut(): void
    {
        $this->user->logout();
        $this->flashMessage('You have been signed out.');
        $this->redirect('signIn');
    }
}