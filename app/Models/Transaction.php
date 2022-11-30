<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'reference',
        'type_id',
        'amount',
        'balance',
        'user_id',
        'client_id',
        'pay_for_month',
    ];

    protected $casts = [
        'pay_for_month' => 'date',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function client () {
        return $this->belongsTo(Client::class);
    }

    public function type () {
        return $this->belongsTo(TransactionType::class, 'type_id');
    }
}
