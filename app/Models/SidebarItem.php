<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'sub_contents'];

    protected $casts = [
        'sub_contents' => 'array',
    ];
}
