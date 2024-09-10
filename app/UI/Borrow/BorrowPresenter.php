<?php

declare(strict_types=1);
namespace App\UI\Borrow;

use Nette\Application\UI\Presenter;
use App\Model\Tool;
use App\Model\Borrow;

class BorrowPresenter extends Presenter
{
    private Tool $toolModel;
    private Borrow $borrowModel;

    public function __construct(Tool $toolModel, Borrow $borrowModel)
    {
        $this->toolModel = $toolModel;
        $this->borrowModel = $borrowModel;
    }

    public function renderDefault(): void
    {
        $this->template->tools = $this->toolModel->getAvailableTools();
    }

     public function handleBorrow(array $toolIds, array $quantities): void
{
    foreach ($toolIds as $index => $toolId) {
        $quantity = (int)$quantities[$index];
        
        if ($quantity > 0) {
            $this->borrowModel->borrowTool($this->getUser()->getId(), $toolId, $quantity);
            $this->toolModel->updateQuantity($toolId, $quantity);
        }
    }
	
    $this->redirect('Homepage:');
}


}
