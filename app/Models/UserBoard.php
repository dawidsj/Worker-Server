<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBoard extends Model
{
    protected $table = 'user_boards';
    const BOARD_ID = 'board_id';
    const USER_ID = 'id';
    const ID = 'id';

    protected $fillable = [
        self::BOARD_ID,
        self::USER_ID,
        self::ID,
    ];
    public function boards():BelongsTo {
        return $this->belongsTo(Board::class, self::BOARD_ID, Board::ID);
    }
    public function owners():BelongsTo {
        return $this->belongsTo(User::class,self::USER_ID, User::ID);
    }
}
