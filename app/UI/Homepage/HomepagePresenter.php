<?php

declare(strict_types=1);

namespace App\UI\Homepage;

use Nette\Application\UI\Presenter;
use App\Model\Tool;
use App\Model\Borrow;

class  HomepagePresenter  extends Presenter
{
    private Tool $toolModel;
    private Borrow $borrowModel;

    public function __construct(Tool $toolModel, Borrow $borrowModel)
    {
        $this->toolModel = $toolModel;
        $this->borrowModel = $borrowModel;
    }

    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }

	public function renderDefault(): void
	{
		$availableTools = $this->toolModel->getAvailableTools();
		$borrowedTools = $this->borrowModel->getBorrowedTools();
	
		$this->template->availableToolsJson = json_encode($availableTools);
		$this->template->borrowedToolsJson = json_encode($borrowedTools);
		
		$this->template->availableTools = $availableTools;
		$this->template->borrowedTools = $borrowedTools;
	}
	
	
}
