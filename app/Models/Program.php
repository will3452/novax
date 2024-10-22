<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'preacher',
        'song_leader',
        'giving',
        'opening_song',
    ];

    protected $casts = ['date' => 'date'];
}
