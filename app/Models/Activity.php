<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'meal_id',
        'exercise_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function meal () {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function exercise () {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }

    public function message () {
        if (! is_null($this->exercise_id)) {
            $name = $this->exercise->name;
            return "you exercise: $name";
        }

        $name = $this->food->name;
        return "you eat: $name";
    }
}
