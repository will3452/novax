<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'description',
        'approved_at',
        'paid_at',
        'request_id', // gcash

    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approved () {
        $this->update(['approved_at' => now()]);
    }

    public function paid () {
        $this->update(['paid_at' => now()]);
    }

    // getters
    public function getUserNameAttribute() {
        return $this->user->name;
    }
}
