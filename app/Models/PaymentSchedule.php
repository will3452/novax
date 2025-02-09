<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_id',
        'amount',
        'due_date',
        'status',
        'revenue',
    ];

    public function loan () {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
    protected $casts = [
        'due_date' => 'date',
    ];
}
