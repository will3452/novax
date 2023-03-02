<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthProblem extends Model
{
    use HasFactory;
    protected $fillable = [
        'HPN',
        'CVD',
        'cancer',
        'renal',
        'diabetes',
        'TB',
        'goiter',
        'others',
        'profile_id',
    ];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
