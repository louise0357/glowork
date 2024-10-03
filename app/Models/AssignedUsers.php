<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedUsers extends Model
{
    protected $table = 'assigned_users';

    protected $fillable = [
        'table_rows_id',
        'user_id',
        'assigned_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $primaryKey = 'id';


    public function row()
    {
        return $this->belongsTo(TableRow::class, 'table_rows_id');
    }
}
