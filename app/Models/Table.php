<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_by'];

    public function columns()
    {
        return $this->hasMany(Column::class);
    }

    public function rows()
    {
        return $this->hasMany(TableRow::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }
}
