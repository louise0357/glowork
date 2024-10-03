<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Call extends Model
{
    use HasApiTokens;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'caller_no',
        'called_no',
        'representative_id',
        'isresponded',
        'call_start_time',
        'call_end_time',
        'call_duration',
        'call_type',
        'call_reason',
        'call_summary',
        'call_notes',
        'personel_evaluation',
        'resolution_status',
        'related_calls'
    ];

    protected $table = 'calls';

     protected $primaryKey = 'call_id';
     protected $casts = [
        'related_calls' => 'array',
    ];
     public $timestamps = false;
}
