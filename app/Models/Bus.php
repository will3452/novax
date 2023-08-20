<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'capacity',
        'plate_number',
        'type',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'bus_id');
    }
}
