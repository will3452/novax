<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const STATUS_FINISHED = 'finished';
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_CANCELLED = 'cancelled';

    use HasFactory;
    protected $guarded = [];
}
