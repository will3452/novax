<?php
namespace App\Models\Traits;

use App\Models\Discount;

trait DiscountedTrait
{
    public function discount () {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}
