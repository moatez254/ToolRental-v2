<?php

declare(strict_types=1);
namespace App\Model;

use Nette\Database\Explorer;

class Tool
{
    private Explorer $database;

    public function __construct(Explorer $database)
    {
        $this->database = $database;
    }

    public function getAllTools()
    {
        return $this->database->table('tools')->fetchAll();
    }

    public function getAvailableTools()
    {
        return $this->database->table('tools')->where('is_available', true)->fetchAssoc('id');
    }
 

    public function updateQuantity(int $toolId, int $quantity)
    {
        $tool = $this->database->table('tools')->get($toolId);
        if ($tool && $tool->quantity >= $quantity) {
            $newQuantity = $tool->quantity - $quantity;
            $tool->update(['quantity' => $newQuantity, 'is_available' => $newQuantity > 0]);
        }
    }

    public function returnTool(int $toolId, int $quantity)
    {
        $tool = $this->database->table('tools')->get($toolId);
        if ($tool) {
            $newQuantity = $tool->quantity + $quantity;
            $tool->update(['quantity' => $newQuantity, 'is_available' => true]);
        }
    }

    public function addTool(string $name, string $description, int $quantity)
    {
        $this->database->table('tools')->insert([
            'name' => $name,
            'description' => $description,
            'quantity' => $quantity,
            'is_available' => $quantity > 0
        ]);
    }

    public function deleteTool(int $toolId)
    {
        $this->database->table('tools')->where('id', $toolId)->delete();
    }
}
