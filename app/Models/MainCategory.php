<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_categories';

    public function tables()
    {
        return $this->hasMany(Table::class, 'main_category_id');
    }
}
