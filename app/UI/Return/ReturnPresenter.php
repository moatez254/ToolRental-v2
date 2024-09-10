<?php

declare(strict_types=1);

namespace App\UI\Return;

use Nette\Application\UI\Presenter;
use App\Model\Borrow;
use App\Model\Tool;

class ReturnPresenter extends Presenter
{
    private Borrow $borrowModel;
    private Tool $toolModel;

    public function __construct(Borrow $borrowModel, Tool $toolModel)
    {
        $this->borrowModel = $borrowModel;
        $this->toolModel = $toolModel;
    }

    public function renderDefault(): void
    {
        $this->template->borrows = $this->borrowModel->getBorrowsByUser($this->getUser()->getId());
    }

    public function handleReturn(int $borrowId, string $status, int $quantity): void
    {
        $this->borrowModel->returnTool($borrowId, $status, $quantity);
        $this->toolModel->returnTool($borrowId, $quantity);
        $this->redirect('Homepage:');
    }
}
