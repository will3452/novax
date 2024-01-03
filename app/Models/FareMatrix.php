<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FareMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_type',
        'from',
        'to',
        'fare',
        'km',
    ];

    protected $casts = [
        'from' => 'int',
        'to' => 'int', 
    ]; 

    public function from () {
        return $this->belongsTo(Terminal::class, 'from'); 
    }

    public function to () {
        return $this->belongsTo(Terminal::class, 'to'); 
    }
}
