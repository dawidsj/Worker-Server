<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table = 'tasks';
    const ID = 'id';
    const CREATED_BY = 'created_by';
    const ASSIGNED_TO = 'assigned_to';
    const LIST_ID = 'list_id';
    const TITLE = 'title';
    const CONTENT = 'content';

    protected $fillable = [
        self::ID,
        self::CREATED_BY,
        self::ASSIGNED_TO,
        self::LIST_ID,
        self::TITLE,
        self::CONTENT,
    ];
    public function lists():BelongsTo {
        return $this->belongsTo(Lists::class, self::LIST_ID, Lists::ID);
    }
    public function createBy():BelongsTo {
        return $this->belongsTo(User::class, self::CREATED_BY, User::ID);
    }
    public function assignedTo():BelongsTo {
        return $this->belongsTo(User::class, self::ASSIGNED_TO, User::ID);
    }
}
