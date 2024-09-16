<?php

declare(strict_types=1);

namespace App\UI\Homepage;


use Nette;

final class homepagePresenter extends BasePresenter
{
    private Nette\Database\Explorer $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function renderDefault(): void
    {
        $tools = $this->database->table('tools')->fetchAll();
        $this->template->tools = $tools;

        
        $toolNames = [];
        $toolQuantities = [];

        foreach ($tools as $tool) {
            $toolNames[] = $tool->name;
            $toolQuantities[] = $tool->quantity;
        }

        $this->template->toolNamesJson = json_encode($toolNames);
        $this->template->toolQuantitiesJson = json_encode($toolQuantities);
    }
}