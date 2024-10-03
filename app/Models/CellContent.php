<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellContent extends Model
{
    use HasFactory;

    protected $fillable = ['table_rows_id', 'column_id', 'contents'];

    public function tableRow()
    {
        return $this->belongsTo(TableRow::class);
    }

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
    public $timestamps = false;

}
