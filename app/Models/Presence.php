<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'date',
        'punch_in',
        'punch_out',
        'break',
        'production',
        
        
    ];
}
