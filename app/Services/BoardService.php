<?php
namespace App\Services;

use App\Models\Board;
use App\Models\UserBoard;
use Illuminate\Support\Collection;

class  BoardService {

    private $board;
    private $userBoard;

    public function __construct(Board $board, UserBoard $userBoard)
    {
        $this->board = $board;
        $this->userBoard = $userBoard;
    }

    public function getOwnerBoards(int $ownerId): ?Collection {
        return $this->board->where(Board::OWNER_ID, '=', $ownerId)->get();
    }

    public function getParticipantBoards(int $userId): ?Collection {
        return $this->userBoard->where(UserBoard::USER_ID, '=', $userId)->with('boards')->get();
    }
}
