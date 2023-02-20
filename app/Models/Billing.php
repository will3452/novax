<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'payee_id',
        'payer_id',
        'amount',
        'month',
        'year',
        'mode',
        'reference',
        'room_id',
    ];

    public function payer () {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function payee () {
        return $this->belongsTo(User::class, 'payee_id');
    }

    public function room () {
        return $this->belongsTo(Room::class);
    }
}
