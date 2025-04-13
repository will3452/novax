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
        'created_at',
    ];

    public function penalties () {
        return $this->hasMany(Penalty::class, 'payment_schedule_id');
    }

    public function loan () {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function getTotalPenaltiesAttribute() {
        $total = 0;
        foreach($this->penalties()->get() as $p) {
            $total += $p->amount;
        }
        return $total;
    }
    protected $casts = [
        'due_date' => 'date',
    ];
}
