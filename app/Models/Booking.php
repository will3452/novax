<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date', 
        'time',
        'remarks',
        'service', 
        'status', // PENDING, DONE, CANCELLED
    ]; 

    protected $casts = [
        'date' => 'date',
    ]; 

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }
}
