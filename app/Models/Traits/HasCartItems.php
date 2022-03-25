<?php

namespace App\Models\Traits;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;

trait HasCartItems
{
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'user_id');
    }

    public function addToCart($productId, $quantity)
    {
        $this->removeToCart($productId);
        return $this->cartItems()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function removeToCart($productId, $processed = false)
    {
        if ($this->cartItems()->whereProductId($productId)->count()) {
            $item = $this->cartItems()->whereProductId($productId)->first();
            if ($processed) {
                $item->product->quantity -= $item->quantity;
                $item->product->save();
            }
            return $item->delete();
        }
    }

    public function clearCart()
    {
        foreach ($this->cartItems as $c) {
            $c->delete();
        }
    }

    public function createSale($product, $qty, $sub)
    {
        return Sale::create([
            'store_id' => $product->store_id,
            'product_id' => $product->id,
            'quantity' => $qty,
            'price' => $product->price,
            'total' => $sub,
        ]);
    }

    public function createOrder($itemsBreakdown, $sub, $vatDue, $vatRate, $total, $address, $remarks)
    {
        return $this->orders()->create([
            'itemsBreakdown' => $itemsBreakdown,
            'subTotal' => $sub,
            'vatDue' => $vatDue,
            'vatRate' => $vatRate,
            'total' => $total,
            'address' => $address ?? $this->address,
            'remarks' => $remarks ?? "---",
        ]);
    }

    public function processCartToOrder($address=null, $remarks=null)
    {
        if (! count($this->cartItems)) {
            return false;
        }
        $sub = 0;
        $itemsBreakdown = "";
        foreach ($this->cartItems as $c) {
            $sub += $c->product->price * $c->quantity;
            $product = $c->product;
            $this->createSale($product, $c->quantity, $sub);
            $itemsBreakdown .= "$product->id***$product->name***$product->price***$c->quantity\n";
            $this->removeToCart($product->id, true);
        }
        $vat = nova_get_setting('vat', 0.12);
        $vatDue = ($sub * $vat);
        $total = $vatDue + $sub;
        return $this->createOrder($itemsBreakdown, $sub, $vatDue, $vat, $total, $address, $remarks);
    }
}
