<?php

namespace App\Http\Controllers;

use App\Services\BoardService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use JWTAuth;

class BoardController extends Controller
{
    private $boardService;

    public function __construct(BoardService $boardService) {
        $this->boardService = $boardService;
    }
    public function getUserBoards() {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Użytkownik nie został znaleziony'], 404);
        }
    }

    public function getOwnerBoards(): ?Collection {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Użytkownik nie został znaleziony'], 404);
        }
        return $this->boardService->getOwnerBoards($user->id);
    }

    public function getParticipantBoards(): ?Collection {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Użytkownik nie został znaleziony'], 404);
        }
        return $this->boardService->getParticipantBoards($user->id);
    }

    public function getBoardsContent(Request $request): ?Collection {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Użytkownik nie został znaleziony'], 404);
        }

        $boardId = $request->get('boardId');

        if (!empty($boardId) || !is_numeric($boardId)) {
            return $this->boardService->getBoardsContent($boardId, $user->id);
        }
        return response()->json(['Nie znaleziono zmiennej boardId lub nie jest ona liczbą'], 406);
    }

    public function createBoard(Request $request): bool {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Użytkownik nie został znaleziony'], 404);
        }

        $boardName = $request->get('boardName');

        if (!empty($boardName)) {
            return $this->boardService->createBoard($boardName, $user->id);
        }
        return response()->json(['Nie znaleziono zmiennej boardName'], 406);
    }

    public function test() {
        $userId = 1;
        $boardId = 1;

        return $this->boardService->getBoardsContent($boardId, $userId);
    }
}
