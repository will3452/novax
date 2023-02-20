<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'date',
        'status',
        'room_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    const STATUS_DONE = 'Done';
    const STATUS_PENDING = 'Pending';

    public function room () {
        return $this->belongsTo(Room::class, 'room_id');
    }

}
