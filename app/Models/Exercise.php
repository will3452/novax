<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'scale',
        'name',
        'type',
        'image',
        'instruction',
        'benefits',
    ];

    public function program () {
        return $this->belongsTo(Program::class);
    }

    public function getTakenAttribute() {
        return Activity::whereUserId(auth()->id())->whereExerciseId($this->id)->exists();
    }
}
