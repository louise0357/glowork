<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanTask extends Model
{

    protected $fillable = [
        'list_id', 'name', 'description', 'type', 'table_rows', 'due_date', 'label', 'badge', 'assigned_user'
    ];
    
    public function list()
    {
        return $this->belongsTo(KanbanList::class, 'list_id');
    }
    public function comments()
    {
        return $this->hasMany(KanbanComment::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'kanban_task_users', 'task_id', 'user_id');
}

}