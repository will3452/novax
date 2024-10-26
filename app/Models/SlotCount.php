<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'count',
    ];

    protected $casts = ['date' => 'date'];
}
