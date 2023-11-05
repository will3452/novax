<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_lat',
        'to_lat',
        'from_lng',
        'to_lng',
        'name',
        'fare', 
    ]; 
}
