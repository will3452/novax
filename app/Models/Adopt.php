<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopt extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'user_id',
    ];
}
