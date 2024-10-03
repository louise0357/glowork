<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanMainCategory extends Model
{
    protected $fillable = ['name'];

    public function boards()
    {
        return $this->hasMany(KanbanBoard::class, 'main');
    }
}
