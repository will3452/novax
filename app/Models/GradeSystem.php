<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attendance',
        'recitation',
        'assignment',
        'long_test',
        'major_exam',
        'quiz',
    ];
}
