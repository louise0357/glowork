<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'phone_number',
        'address',
        'city',
        'county',
        'postal_code',
        'country',
        'date_of_birth',
        'registration_date',
        'last_purchase_date',
        'customer_status'
    ];

    public $timestamps = false;
}
