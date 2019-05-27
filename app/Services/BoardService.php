<?php
namespace App\Services;

use App\Models\Board;
use Illuminate\Support\Collection;

class  BoardService {

    private $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function getOwnerBoards(int $ownerId): ?Collection {
        return $this->board->where(Board::OWNER_ID, '=', $ownerId)->get();
    }
}
