<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanBoard extends Model
{
    public function lists()
    {
        return $this->hasMany(KanbanList::class, 'board_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(KanbanMainCategory::class, 'main');
    }
}
