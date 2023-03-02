<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOfTheFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class);
    }
}
