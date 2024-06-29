<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'reference',
        'total_amount',
        'status', 
    ]; 

    public function customer () {
        return $this->belongsTo(User::class, 'customer_id'); 
    }

    const ORDER_STATUS = ['PROCESSING', 'SHIPPED', 'DELIVERED', 'CANCELLED']; 
}
