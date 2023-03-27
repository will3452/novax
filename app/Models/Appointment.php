<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'symptoms',
        'alert',
        'description_1',
        'user_id',
        'date',
        'time',
        'description',
        'approved_at',
        'link',
        'proof_of_payment',
        'paid_at',
        'request_id', // gcash
        'type',
    ];

    protected $casts = [
        'date' => 'date',
        'symptoms' => 'array',
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
