<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_id',
        'user_id',
        'due_date',
        'penalty',
        'amount',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loan () {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
