<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'lmp',
        'edc',
        'gp',
        'wt',
        'bp',
        'husband',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class);
    }
}
