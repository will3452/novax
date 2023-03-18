<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'common_name',
        'scientific_name',
        'habitat',
        'family',
        'description',
        'tips',
        'temp',
        'air',
        'light',
        'image',
    ];
}
