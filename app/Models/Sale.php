<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'store_id',
        'order_item_id',
        'order_id',
        'customer_id',
        'product_id',
        'quantity_sold',
        'unit_price',
        'total_price',
        'discount',
        'tax_applied',
        'shipping_cost',
        'total_revenue',
        'payment_method',
        'shipping_address',
        'shipping_city',
        'shipping_province',
        'shipping_postal',
        'shipping_country',
        'shipping_method',
        'shipping_cost',
        'shipping_tracking_number',
        'shipping_status',
    ]; 

}
