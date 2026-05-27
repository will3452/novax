<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_CONFIRMED = 'CONFIRMED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_CANCELED = 'CANCELED';

    protected $fillable = [
        'employee_id',
        'status',
    ];

    /**
     * Relationship to the User who created the order.
     */
    public function employee() {
        return $this->belongsTo(\App\Models\User::class, 'employee_id');
    }

    /**
     * Relationship to the individual items in the order.
     */
    public function orderItems()
{
    return $this->hasMany(\App\Models\OrderItem::class);
}

    /**
     * FIX: Calculate the total amount safely.
     * This prevents the "property 'price' on null" error.
     */
    public function getTotalAmountAttribute()
    {
        return $this->orderItems()
            ->whereHas('product') // Only include items with valid products
            ->get()
            ->sum(function ($item) {
                return ($item->qty ?? 0) * ($item->price ?? 0);
            });
    }
    
    
}