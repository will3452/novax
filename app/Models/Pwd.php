<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pwd extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_disability',
        'pwd_id',
        'remarks',
        'profile_id',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class);
    }
}
