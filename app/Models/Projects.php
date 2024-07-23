<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'name_project',
        'from_date',
        'to_date',
        'statut',
       
        
    ];
}
