<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'user_id',
        'notes',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    const STATUS_PENDING = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_COMPLETED = 'Completed';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
