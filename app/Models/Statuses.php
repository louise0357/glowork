<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'table_id',
        'name',
        'class'
    ];

    protected $table = 'statuses';

     protected $primaryKey = 'id';

     public $timestamps = true;
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
