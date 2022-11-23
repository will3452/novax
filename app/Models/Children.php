<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $fillable  = [
        'mother_profile_id',
        'child_profile_id',
        'wt',
    ];

    public function child () {
        return $this->belongsTo(Profile::class, 'child_profile_id');
    }

    public function mother () {
        return $this->belongsTo(Profile::class, 'mother_profile_id');
    }
}
