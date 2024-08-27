<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'in',
        'out',
        'place_in',
        'place_out',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    protected $casts = [
        'in' => 'datetime',
        'out' => 'datetime', 
    ]; 
}
