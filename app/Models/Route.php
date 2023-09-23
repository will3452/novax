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

}
