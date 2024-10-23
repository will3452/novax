<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'date',
        'amount',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function program () {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
