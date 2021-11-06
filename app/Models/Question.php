<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getCorrectAnswersAttribute()
    {
        $corrects = $this->answers()->where('type', Answer::TYPE_CORRECT)->get()->pluck('value');

        return implode(', ', $corrects->toArray());
    }
}
