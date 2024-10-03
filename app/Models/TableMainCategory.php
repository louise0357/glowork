<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableMainCategory extends Model
{

    protected $table = 'main_categories';

    protected $fillable = ['name'];

    public function boards()
    {
        return $this->hasMany(Table::class, 'main_category_id');
    }
}
