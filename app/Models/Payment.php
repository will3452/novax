<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_id',
        'amount',
    ]; 

    public function billing () {
        return $this->belongsTo(Billing::class, 'billing_id'); 
    }
}
