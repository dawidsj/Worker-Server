<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lists extends Model
{
    protected $table = 'lists';
    const ID = 'id';
    const BOARD_ID = 'board_id';
    const NAME = 'name';
    const ORDER = 'order';

    protected $fillable = [
        self::ID,
        self::BOARD_ID,
        self::NAME,
        self::ORDER,
    ];

    public function tasks(): HasMany {
        return $this->hasMany(Task::class, Task::LIST_ID, self::ID);
    }
    public function boards():BelongsTo {
        return $this->belongsTo(Board::class, self::BOARD_ID, Board::ID);
    }
}
