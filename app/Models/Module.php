<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    const TYPE_EXERCISE = 'Exercise';
    const TYPE_MEAL = 'Meal';

    const DAY_OPTIONS = [
        'mon' => 'mon',
        'tue' => 'tue',
        'wed' => 'wed',
        'thu' => 'thu',
        'fri' => 'fri',
        'sat' => 'sat',
        'sun' => 'sun',
    ];

    protected $fillable = [
        'week_id',
        'day',
        'muscle_group',
        'type',
    ];

    public function week()
    {
       return $this->belongsTo(Week::class, 'week_id');
    }

    public function instructions()
    {
       return $this->hasMany(Instruction::class, 'module_id');
    }

    //actions
    public function markAsDone()
    {
       UserModule::create([
           'module_id' => $this->id,
           'user_id' => auth()->id(),
       ]);
    }
}
