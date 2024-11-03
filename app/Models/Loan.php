<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'terms',
        'amount',
        'interest',
        'payment_schedule',
        'start_date',
        'status',
        'reference',
        'end_date',
        'collateral',
        'collateral_image',
        'status',
    ];

    public function getTotalPayableAttribute() {
        return $this->amount + $this->penalties()->sum('amount');
        return ;
    }

    public function getPaymentStatusAttribute() {
        $totalPayment = $this->total_payable;
        if ($totalPayment <= $this->payments()->sum('amount')) {
            return "PAID";
        }
        return "PENDING";
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function users () {
        return $this->belongsToMany(User::class, 'user_loans', 'loan_id', 'user_id')->withPivot('group_id');
    }

    public function userLoans () {
        return $this->hasMany(UserLoan::class, 'loan_id');
    }

    public function payments () {
        return $this->hasMany(Payment::class, 'loan_id');
    }

    public function schedules () {
        return $this->hasMany(PaymentSchedule::class, 'loan_id');
    }

    public function penalties () {
        return $this->hasMany(Penalty::class, 'loan_id');
    }
}
