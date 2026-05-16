<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'name',
        'email',
        'phone',
        'major',
        'address',
        'city',
        'province',
        'birth_date',
        'gender',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
