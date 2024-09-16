<?php

declare(strict_types=1);
namespace App\UI\Borrow;

use App\UI\homepage\BasePresenter;
use Nette;
use Nette\Application\UI\Form;

final class BorrowPresenter extends BasePresenter
{
    private Nette\Database\Explorer $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function renderDefault(): void
    {
        $this->template->tools = $this->database->table('tools')->where('quantity > ?', 0)->fetchAll();
    }

    protected function createComponentBorrowForm(): Form
    {
        $form = new Form;

        $tools = $this->database->table('tools')->where('quantity > ?', 0)->fetchPairs('id', 'name');

        $form->addCheckboxList('tool_ids', 'Select Tools:', $tools)
            ->setRequired('Please select at least one tool.');

        $form->addTextArea('purpose', 'Purpose:')
            ->setRequired('Please describe the purpose.');

        $form->addSubmit('borrow', 'Borrow Tools');

        $form->onSuccess[] = [$this, 'borrowFormSucceeded'];

        return $form;
    }

    public function borrowFormSucceeded(Form $form, \stdClass $values): void
    {
        $userId = $this->user->getId();
        $toolIds = $values->tool_ids;

        foreach ($toolIds as $toolId) {
            $this->database->beginTransaction();
            try {
                // Decrease the tool quantity
                $tool = $this->database->table('tools')->get($toolId);
                if ($tool->quantity <= 0) {
                    throw new \Exception('Tool not available.');
                }
                $tool->update(['quantity' => $tool->quantity - 1]);

                // Record the borrowed tool
                $this->database->table('borrowed_tools')->insert([
                    'user_id' => $userId,
                    'tool_id' => $toolId,
                    'quantity' => 1,
                    'purpose' => $values->purpose,
                ]);

                $this->database->commit();
            } catch (\Exception $e) {
                $this->database->rollBack();
                $form->addError('An error occurred while borrowing tools: ' . $e->getMessage());
                return;
            }
        }

        $this->flashMessage('Tools borrowed successfully.', 'success');
        $this->redirect('Homepage:default');
    }
}