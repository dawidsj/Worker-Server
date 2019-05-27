<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    protected $table = 'boards';
    const ID = 'id';
    const OWNER_ID = 'owner_id';
    const NAME = 'name';

    protected $fillable = [
        self::ID,
        self::OWNER_ID,
        self::NAME,
    ];

    public function userBoard(): HasMany {
        return $this->hasMany(UserBoard::class, UserBoard::BOARD_ID, self::ID);
    }

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, self::OWNER_ID, User::ID);
    }
    public function lists(): HasMany {
        return $this->hasMany(Lists::class, Lists::BOARD_ID, self::ID);
    }

}
