<?php

declare(strict_types=1);
namespace App\UI\homepage;

use Nette;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    public function startup(): void
    {
        parent::startup();
        if (!$this->user->isLoggedIn() && $this->getName() !== 'Sign') {
            $this->redirect('Sign:in');
        }
    }
}
