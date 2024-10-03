<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'name', 'type'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function cellContents()
    {
        return $this->hasMany(CellContent::class);
    }
}
