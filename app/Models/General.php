<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = [
        'temp',
        'bp',
        'hr',
        'pr',
        'o2_level',
        'chief_complaint',
        'treatment_management',
        'profile_id'
    ];

    public function profile () {
        return $this->belongsTo(Profile::class);
    }
}
