<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentalDescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
    ];

    protected $with = [
        'topics'
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
