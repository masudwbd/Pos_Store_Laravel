<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'date',
        'year',
        'attendance',
        'edit_date',
    ];
}
