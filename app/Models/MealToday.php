<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealToday extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'lunch_id',
        'dinner_id',
        'supper_id',
        'breakfast_id',
    ];
}
