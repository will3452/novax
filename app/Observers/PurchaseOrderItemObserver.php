<?php

namespace App\Observers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

class PurchaseOrderItemObserver
{
    /**
     * Handle the PurchaseOrderItem "created" event.
     *
     * @param  \App\Models\PurchaseOrderItem  $purchaseOrderItem
     * @return void
     */
    public function created(PurchaseOrderItem $purchaseOrderItem)
    {
        $po = PurchaseOrder::find($purchaseOrderItem->purchase_order_id);
        $total_cost = 0;
        $poi = PurchaseOrderItem::where([
            'purchase_order_id' => $po->id,
        ])->get();

        foreach ($poi as $p) {
            $total_cost += ($p->cost * $p->qty);
        }

        $po->update(['total_cost' => $total_cost]);
    }

    /**
     * Handle the PurchaseOrderItem "updated" event.
     *
     * @param  \App\Models\PurchaseOrderItem  $purchaseOrderItem
     * @return void
     */
    public function updated(PurchaseOrderItem $purchaseOrderItem)
    {
        //
    }

    /**
     * Handle the PurchaseOrderItem "deleted" event.
     *
     * @param  \App\Models\PurchaseOrderItem  $purchaseOrderItem
     * @return void
     */
    public function deleted(PurchaseOrderItem $purchaseOrderItem)
    {
        //
    }

    /**
     * Handle the PurchaseOrderItem "restored" event.
     *
     * @param  \App\Models\PurchaseOrderItem  $purchaseOrderItem
     * @return void
     */
    public function restored(PurchaseOrderItem $purchaseOrderItem)
    {
        //
    }

    /**
     * Handle the PurchaseOrderItem "force deleted" event.
     *
     * @param  \App\Models\PurchaseOrderItem  $purchaseOrderItem
     * @return void
     */
    public function forceDeleted(PurchaseOrderItem $purchaseOrderItem)
    {
        //
    }
}
