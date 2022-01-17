<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    protected $fillable = [
        'difficulty_id',
        'sequence',
    ];

    public function difficulty()
    {
       return $this->belongsTo(Difficulty::class, 'difficulty_id');
    }
}
