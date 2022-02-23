<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'year_level',
        'name',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
