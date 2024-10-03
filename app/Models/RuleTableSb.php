<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleTableSb extends Model
{
    use HasFactory;

    protected $table = 'rule_tables_sb';

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function rules()
    {
        return $this->hasMany(RuleTable::class, 'table_id', 'id');
    }
}
