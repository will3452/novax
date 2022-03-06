<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    const OPTIONS = [
        'users' => 'users',
        'subjects' => 'subjects',
        'rooms' => 'rooms',
        'year-level' => 'year-level',
    ];
}
