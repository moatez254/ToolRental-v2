<?php

declare(strict_types=1);
namespace App\Model;

use Nette\Database\Explorer;
use Nette\Utils\DateTime;

class Borrow
{
    private Explorer $database;

    public function __construct(Explorer $database)
    {
        $this->database = $database;
    }
	public function borrowTool(int $userId, int $toolId, int $quantity)
	{
		$this->database->table('tools')
			->where('id', $toolId)
			->update([
			'id' => $toolId,
			'quantity' => $quantity,
		]);
	}
	
    public function returnTool(int $borrowId, string $status, int $quantity)
    {
        $borrow = $this->database->table('borrows')->get($borrowId);
        if ($borrow) {
            $borrow->update([
                'return_date' => new DateTime(),
                'status' => $status
            ]);
        }
    }

	public function getBorrowsByUser(int $userId)
	{
		return $this->database->table('borrows')
			->where('user_id', $userId)
			->where('return_date IS NULL')  
			->fetchAll();
	}
	
	
    public function getBorrowedTools()
    {
        return $this->database->table('borrows')->where('return_date IS NULL')->fetchAll();
    }
}
