<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'adviser_id',
    ];

    public function adviser () {
        return $this->belongsTo(Instructor::class, 'adviser_id');
    }
}
