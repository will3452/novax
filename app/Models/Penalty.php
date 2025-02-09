<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_id',
        'payment_schedule_id',
        'amount',
        'notes',
    ];

    public function schedule () {
        return $this->belongsTo(PaymentSchedule::class, 'payment_schedule_id');
    }

    public function loan () {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
