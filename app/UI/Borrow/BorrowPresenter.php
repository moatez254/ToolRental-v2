<?php

declare(strict_types=1);
namespace App\UI\Borrow;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use App\Model\Tool;
use App\Model\Borrow;
use stdClass;

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
	protected function createComponentBorrowForm(): Form
	{
		$form = new Form;
		$tools = $this->toolModel->getAvailableTools();
		foreach ($tools as $id => $tool) {
			$form->addInteger("$id", $tool['name'])
				->setDefaultValue(1)
				->addRule($form::RANGE, 'Quantity must be between 1 and ' . $tool['quantity'], [1, $tool['quantity']]);
		}
	
		$form->addSubmit('submit', 'Borrow Tools');
		$form->onSuccess[] = [$this, 'borrowFormSucceeded'];
		return $form;
	}

	public function borrowFormSucceeded(Form $form, stdClass $values): void
	{
		foreach ($values as $id => $quantity) {
			if ($quantity === 0) {
				continue;
			} 
			$this->borrowModel->borrowTool($this->getUser()->getId(),(int) $id, $quantity);
			$this->toolModel->updateQuantity((int) $id, $quantity);
				}
	
		$this->redirect('Homepage:');
	}
	
}
