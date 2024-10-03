<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableRow extends Model
{
    use HasFactory;

    protected $fillable = ['table_id'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function cellContents()
    {
        return $this->hasMany(CellContent::class, 'table_rows_id', 'id');
    }
    public function getContentForColumn($columnId)
    {
        $cellContent = $this->cellContents()->where('column_id', $columnId)->first();
        
        return $cellContent ? $cellContent->content : '';
    }
}
