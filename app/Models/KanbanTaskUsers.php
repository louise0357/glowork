<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanbanTaskUsers extends Model
{
    use HasFactory;

    protected $table = 'kanban_task_users';

    protected $fillable = [
        'task_id',
        'user_id',
        'assigned_at',
    ];

    public $timestamps = false;
}
