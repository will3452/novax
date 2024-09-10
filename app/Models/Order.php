<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'status',
        'sales_associate_id',
        'quantity', 
        'amount', 
        'customer_id', 
    ]; 

    public function product () {
        return $this->belongsTo(Product::class, 'product_id'); 
    }

    public function salesAssociate() {
        return $this->belongsTo(User::class, 'sales_associate_id'); 
    }

    public function customer () {
        return $this->belongsTo(Customer::class, 'customer_id'); 
    }
}
