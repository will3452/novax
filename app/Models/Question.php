<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'questionable_id',
        'questionable_type',
        'question',
        'type', // nullable just incase
    ];

    protected $with = [
        'answers',
    ];

    public function questionable()
    {
        return $this->morphTo();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
