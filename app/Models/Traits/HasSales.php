<?php

namespace App\Models\Traits;

use App\Models\Inventory;
use App\Models\Sale;

trait HasSales
{
    public function sales()
    {
        return $this->hasMany(Sale::class, 'user_id');
    }

    public function processSales($cash, $change)
    {
        $this->sales()->create([
            'cash' => $cash,
            'change' => $change,
            'total_cost' => $this->grandTotal(),
            'vat_due' => $this->vatDue($this->itemSubtotal()),
            'sub_total' => $this->itemSubtotal(),
        ]);

        $this->paidItems();
    }

    public function paidItems()
    {
        $this->items()->each(function ($e) {
            $e->update([
                'is_paid' => true,
            ]);
            $newQuantity = $e->product->quantity - $e->quantity;
            $e->product->adjustInventory($newQuantity, $action = Inventory::ACTION_SOLD);
        });
    }
}
