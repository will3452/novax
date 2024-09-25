<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'due_date', 
        'status', 
    ]; 

    public function loan () {
        return $this->belongsTo(Loan::class, 'loan_id'); 
    }
    protected $casts = [
        'due_date' => 'date', 
    ];
}
