<?php

declare(strict_types=1);
namespace App\UI\Manage;

use Nette\Application\UI\Presenter;
use App\Model\Tool;

class ManagePresenter extends Presenter
{
    private Tool $toolModel;

    public function __construct(Tool $toolModel)
    {
        $this->toolModel = $toolModel;
    }

    public function renderDefault(): void
    {
        $this->template->tools = $this->toolModel->getAllTools();
    }

    public function handleDelete(int $toolId): void
    {
        $this->toolModel->deleteTool($toolId);
        $this->redirect('this');
    }

    public function handleAdd(string $name, string $description, int $quantity): void
    {
        $this->toolModel->addTool($name, $description, $quantity);
        $this->redirect('this');
    }
}
