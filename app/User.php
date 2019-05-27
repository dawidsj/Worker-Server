<?php

namespace App;

use App\Models\Board;
use App\Models\Task;
use App\Models\UserBoard;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ID = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function createdBy():HasMany {
        return $this->hasMany(Task::class, Task::CREATED_BY, self::ID);
    }
    public function assignedTo():HasMany {
        return $this->hasMany(Task::class, Task::ASSIGNED_TO, self::ID);
    }
    public function userBoards():HasMany {
        return $this->hasMany(Task::class, UserBoard::USER_ID, self::ID);
    }
    public function boards():HasMany {
        return $this->hasMany(Task::class, Board::OWNER_ID, self::ID);
    }
}
