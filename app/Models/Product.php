<?php

namespace App\Models;

use Google\Service\CloudIAP\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Product extends Model
{
    use HasFactory;

    public function owner () {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function store () {
        return $this->belongsTo(Store::class, 'store_id'); 
    }

    public function brand () {
        return $this->belongsTo(ProductBrand::class, 'brand_id'); 
    }

    protected $fillable = [
        'store_id',
        'user_id',
        'brand_id',
        'name',
        'description',
        'category',
        'product_type',
        'price',
        'discount_price',
        'primary_image',
        'available_release_date',
        'available_status', 
        'images', 
        'label', 
        'sizes',
        'colors',
        'attributes', 
    ]; 

    protected $casts = [
        'images' => FlexibleCast::class, 
        'colors' => FlexibleCast::class, 
        'sizes' => FlexibleCast::class, 
        'attributes' => FlexibleCast::class, 
    ]; 

    const STATUSES = ['IN_STOCK', 'OUT_OF_STOCK', 'PRE_ORDER'];
}
