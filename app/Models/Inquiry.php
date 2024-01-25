<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message', 
        'status', 
    ]; 
    const STATUS_DONE = 'DONE';
    const STATUS_NEW = 'NEW'; 
}
