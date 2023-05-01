<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'max_score',
        'student_id',
        'teaching_load_id',
        'activity_id',
    ];
}
