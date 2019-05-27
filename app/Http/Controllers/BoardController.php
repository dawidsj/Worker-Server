<?php

namespace App\Http\Controllers;

use App\Services\BoardService;
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

}
