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

    public function getBoardsContent(int $boardId, int $userId) {

        if ($this->userHasAccessToBoard($boardId, $userId)) {
            return $this->board->where(Board::ID, '=', $boardId)->with('lists.tasks')->get();
        }
        return response()->json(['Użytkownik nie ma dostępu do tej tablicy!'], 403);
    }

    public function createBoard(string $boardName, int $userId): bool {
        return $this->board->save([
           Board::OWNER_ID => $userId,
           Board::NAME => $boardName,
        ]);
    }

    private function userHasAccessToBoard(int  $boardId, int $userId): bool {
        $board = $this->board->where(Board::OWNER_ID, '=', $userId)->where(Board::ID, '=', $boardId)->first();
        $userBoard = $this->userBoard->where(UserBoard::BOARD_ID, '=', $boardId)->where(UserBoard::USER_ID, '=', $userId)->first();

        return !empty($board) || !empty($userBoard);
    }
}
