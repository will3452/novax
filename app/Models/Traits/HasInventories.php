<?php

namespace App\Models\Traits;

use App\Models\Inventory;


trait HasInventories
{
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }

    public function getQuantityAttribute()
    {
        if (! $this->hasInventory()) {
            return 0;
        }
        return $this->inventories()->latest()->first()->quantity;
    }

    public function getTotalCostAttribute() {
        if (! $this->hasInventory()) {
            return 0;
        }

        return $this->quantity * $this->price;
    }

    public function hasInventory(): bool
    {
        return $this->inventories()->count() > 0;
    }

    public function adjustInventory($quantity, $action = null)
    {
        if (is_null($action)) {
            $action = Inventory::ACTION_ADJUSTMENT;
        }
        $this->inventories()->create([
            'user_id' => auth()->id(),
            'action' => $action,
            'quantity' => $quantity,
        ]);
    }
}
