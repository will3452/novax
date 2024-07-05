<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Store extends Model
{
    use HasFactory;

    public function owner () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products () {
        return $this->hasMany(Product::class, 'store_id');
    }

    protected $casts = [
        'bank_account' => FlexibleCast::class,
    ];

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'banner',
        'description',
        'category',
        'address',
        'phone',
        'city',
        'province',
        'postal',
        'country',
        'business_license_number',
        'tax_identification_number',
        'opening_hours',
        'closing_hours',
        'days_closed',
        'bank_account',
        'facebook',
        'instagram',
        'twitter',
        'linkedIn',
        'average_rating',
        'is_private',
    ];
}
