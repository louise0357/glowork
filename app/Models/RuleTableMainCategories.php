<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleTableMainCategories extends Model
{
    use HasFactory;

    protected $table = 'rule_tables_main_categories';

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;


public function rules()
{
    return $this->hasMany(RuleTable::class, 'main_category_id');
}

}
