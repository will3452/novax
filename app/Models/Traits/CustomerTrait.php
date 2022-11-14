<?php

namespace App\Models\Traits;

use App\Models\Item;
use App\Models\ShippingAddress;

trait CustomerTrait {

    public function items () { // to cart
        return $this->hasMany(Item::class, 'user_id');
    }

    public function checkInCart($productId) {
        return $this->items()->whereNull('order_id')->whereProductId($productId)->exists();
    }

    public function addToCart($productId, $quantity) {
        return $this->items()->create(['product_id' => $productId, 'quantity' => $quantity]);
    }

    public function removeToCart($productId) {
        return $this->items()->whereNull('order_id')->whereProductId($productId)->first()->delete();
    }

    public function hasItem() {
        return $this->items()->whereNull('order_id')->count() > 0;
    }

    public function getTotalItemsAmountAttribute() {
        $total = 0;
        $items = $this->items()->whereNull('order_id')->get();
        foreach($items as $item) {
            $total += ($item->product->price * $item->quantity);
        }

        return $total;
    }

    public function getShippingFeeAttribute() {
        $address = ShippingAddress::whereAddress($this->address)->first();

        if (! $address) {
            $address = ShippingAddress::whereDefault(true)->first();
        }

        return $address->fee ?? 0;
    }

    public function getTotalAmountPayableAttribute() {
        $total = $this->total_items_amount + $this->shipping_fee;
        return $total;
    }

    public function discountedTotalAmount($discountRate = 0) {
        $total =  $this->total_amount_payable;

        return $total - ($total * ($discountRate / 100));
    }
}
