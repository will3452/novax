<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_number',
        'color',
        'capacity',
        'driver_id',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
