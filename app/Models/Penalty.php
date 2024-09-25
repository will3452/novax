<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

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
