<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_at',
        'end_at', 
    ]; 

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ]; 
}
