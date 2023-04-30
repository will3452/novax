<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
        'max_score',
        'term',
        'type',
        'teaching_load_id',
    ];

}
