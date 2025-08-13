<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'particulars',
        'amount',
        'payee_id',
        'mode', // cash, check
        'bank', //
        'token',
    ];

    public function payee () {
        return $this->belongsTo(User::class);
    }

    public function payments () {
        return $this->hasMany(Payment::class);
    }
}
