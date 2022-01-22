<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;
    protected $fillable = [
        'module_id',
        'image',
        'description',
        'name',
        'meal_type',
        'calories',
    ];

    const MEAL_TYPE_OPTIONS = [
        'Breakfast' => 'Breakfast',
        'Lunch' => 'Lunch',
        'Snacks' => 'Snacks',
        'Dinner' => 'Dinner',
    ];

    const MEAL_BREAKFAST = 'Breakfast';
    const MEAL_LUNCH = 'Lunch';
    const MEAL_SNACKS = 'Snacks';
    const MEAL_DINNER = 'Dinner';

    public function module()
    {
       return $this->belongsTo(Module::class, 'module_id');
    }
}
