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

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date', 
    ]; 

    public function users () {
        return $this->belongsToMany(User::class, 'user_loans', 'loan_id', 'user_id'); 
    }
}
