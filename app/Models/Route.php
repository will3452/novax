<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'name',
        'fare',
    ];

    public function from()
    {
        return $this->belongsTo(Terminal::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(Terminal::class, 'to_id');
    }

    public function schedules () {
        return $this->hasMany(Schedule::class, 'route_id'); 
    }

    public function buses () {
        return $this->belongsToMany(Bus::class, 'schedules', 'route_id', 'bus_id'); 
    }

}
