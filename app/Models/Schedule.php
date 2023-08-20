<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'departure',
        'bus_id',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
}
