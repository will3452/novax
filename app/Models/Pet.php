<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'image',
        'gender',
        'size',
        'story',
    ];

    public function adopt()
    {
        return $this->hasOne(Adopt::class, 'pet_id');
    }
}
