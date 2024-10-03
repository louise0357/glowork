<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanList extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'board_id',
        'order',
    ];

    public function tasks()
    {
        return $this->hasMany(KanbanTask::class, 'list_id');    
    }

    public function board()
    {
        return $this->belongsTo(KanbanBoard::class, 'board_id');
    }
}