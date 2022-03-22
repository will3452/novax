<?php

namespace App\Models\Traits;

use App\Models\SaleItem;

trait HasItems
{
    public function salesItems()
    {
        return $this->hasMany(SaleItem::class, 'user_id');
    }

    public function items()
    {
        return $this->salesItems()->where('is_paid',false);
    }

    public function addItem($pId, $quantity = 1)
    {
        if ($this->isAdded($pId)) {
            return 'already added';
        }
        $this->salesItems()->create([
            'product_id' => $pId,
            'quantity' => $quantity,
        ]);
    }

    public function removeItem($pId)
    {
        $this->items()->whereProductId($pId)->first()->delete();
    }

    public function getItems()
    {
        return $this->items()->get();
    }

    public function isAdded($pId): bool
    {
        return $this->items()->whereProductId($pId)->exists();
    }

    public function clearItem()
    {
        $this->items()->get()->each(fn ($i) => $i->delete());
    }

    public function updateQuantity($pId, $qty)
    {
        if (! $this->isAdded($pId)) {
            return 'please add the item first';
        }
        return $this->items()->whereProductId($pId)->first()->update([
            'quantity' => $qty,
        ]);
    }

    public function itemSubtotal()
    {
        $items = $this->items;

        $sub = 0;

        foreach ($items as $i) {
            $price = is_null($i->product->promo()) ? $i->product->price : $i->product->discount_price;
            $sub += ($price * $i->quantity);
        }

        return $sub;
    }

    public function vatDue($sub)
    {
        return ($sub) * (nova_get_setting('vat', 12) / 100);
    }
    public function grandTotal()
    {
        $subTotal = $this->itemSubtotal();
        $vatDue = $this->vatDue($subTotal);
        return $subTotal + $vatDue;
    }
}
