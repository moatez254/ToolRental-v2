<?php

declare(strict_types=1);

namespace App\UI\Return;

use App\UI\homepage\BasePresenter;
use Nette;
use Nette\Application\UI\Form;

final class ReturnPresenter extends BasePresenter
{
    private Nette\Database\Explorer $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function renderDefault(): void
    {
        $userId = $this->user->getId();
        $borrowedTools = $this->database->table('borrowed_tools')
            ->where('user_id', $userId)
            ->where('status', 'borrowed')
            ->fetchAll();

        $this->template->borrowedTools = $borrowedTools;
    }

    protected function createComponentReturnForm(): Form
    {
        $form = new Form;

        $userId = $this->user->getId();
		$borrowedToolsRows = $this->database->table('borrowed_tools')
		->where('user_id', $userId)
		->where('status', 'borrowed')
		->fetchAll();
	
		$borrowedTools = [];
		foreach ($borrowedToolsRows as $row) {
		$tool = $row->ref('tools', 'tool_id');
		$borrowedTools[$row->id] = $tool->name;
	}
	

        $form->addCheckboxList('borrowed_tool_ids', 'Select Tools to Return:', $borrowedTools)
            ->setRequired('Please select at least one tool to return.');

        $form->addSelect('condition', 'Condition upon Return:', [
            'intact' => 'Intact',
            'damaged' => 'Damaged',
            'lost' => 'Lost',
            'consumed' => 'Consumed (not returning)'
        ])
        ->setPrompt('Select Condition')
        ->setRequired('Please select the condition of the tools.');

        $form->addSubmit('return', 'Return Tools');

        $form->onSuccess[] = [$this, 'returnFormSucceeded'];

        return $form;
    }

    public function returnFormSucceeded(Form $form, \stdClass $values): void
    {
        $borrowedToolIds = $values->borrowed_tool_ids;
        $condition = $values->condition;

        foreach ($borrowedToolIds as $borrowedToolId) {
            $this->database->beginTransaction();
            try {
                $borrowedTool = $this->database->table('borrowed_tools')->get($borrowedToolId);

                
                $borrowedTool->update([
                    'status' => 'returned',
                    'condition' => $condition
                ]);

            
                if ($condition === 'intact' || $condition === 'damaged') {
                    $tool = $this->database->table('tools')->get($borrowedTool->tool_id);
                    $tool->update(['quantity' => $tool->quantity + 1]);
                }

                $this->database->commit();
            } catch (\Exception $e) {
                $this->database->rollBack();
                $form->addError('An error occurred while returning tools: ' . $e->getMessage());
                return;
            }
        }

        $this->flashMessage('Tools returned successfully.', 'success');
        $this->redirect('Homepage:default');
    }
}