<?php

declare(strict_types=1);
namespace App\UI\Manage;

use App\UI\homepage\BasePresenter;
use Nette;
use Nette\Application\UI\Form;

final class ManagePresenter extends BasePresenter
{
    private Nette\Database\Explorer $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function startup(): void
    {
        parent::startup();
        if (!$this->user->isInRole('admin')) {
            $this->flashMessage('Access denied.', 'error');
            $this->redirect('Dashboard:default');
        }
    }

    public function renderDefault(): void
    {
        $this->template->tools = $this->database->table('tools')->fetchAll();
        $this->template->borrowedTools = $this->database->table('borrowed_tools')->order('borrowed_at DESC')->fetchAll();
    }

    protected function createComponentToolForm(): Form
    {
        $form = new Form;

        $form->addText('name', 'Tool Name:')
            ->setRequired('Please enter the tool name.');

        $form->addInteger('quantity', 'Quantity:')
            ->setRequired('Please enter the quantity.')
            ->addRule($form::MIN, 'Quantity must be at least %d.', 1);

        $form->addTextArea('description', 'Description:')
            ->setNullable();

        $form->addSubmit('save', 'Add Tool');

        $form->onSuccess[] = [$this, 'toolFormSucceeded'];

        return $form;
    }

    public function toolFormSucceeded(Form $form, \stdClass $values): void
    {
        $this->database->table('tools')->insert([
            'name' => $values->name,
            'quantity' => $values->quantity,
            'description' => $values->description,
        ]);

        $this->flashMessage('Tool added successfully.', 'success');
        $this->redirect('this');
    }

    public function handleDeleteTool(int $toolId): void
    {
        $this->database->table('tools')->get($toolId)->delete();
        $this->flashMessage('Tool deleted.', 'info');
        $this->redirect('this');
    }
}