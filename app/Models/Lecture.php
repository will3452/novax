<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'title',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
