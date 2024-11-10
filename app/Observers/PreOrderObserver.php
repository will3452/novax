<?php

namespace App\Observers;

use App\Models\PreOrder;
use App\Models\ProductInventory;

class PreOrderObserver
{
    /**
     * Handle the PreOrder "created" event.
     *
     * @param  \App\Models\PreOrder  $preOrder
     * @return void
     */
    public function created(PreOrder $preOrder)
    {
        //
    }

    /**
     * Handle the PreOrder "updated" event.
     *
     * @param  \App\Models\PreOrder  $preOrder
     * @return void
     */
    public function updated(PreOrder $preOrder)
    {
        if ($preOrder->status == 'Confirmed') {
            foreach ($preOrder->items as $item) {
                ProductInventory::create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'type' => 'ORDER',
                ]);
            }
        }
    }

    /**
     * Handle the PreOrder "deleted" event.
     *
     * @param  \App\Models\PreOrder  $preOrder
     * @return void
     */
    public function deleted(PreOrder $preOrder)
    {
        //
    }

    /**
     * Handle the PreOrder "restored" event.
     *
     * @param  \App\Models\PreOrder  $preOrder
     * @return void
     */
    public function restored(PreOrder $preOrder)
    {
        //
    }

    /**
     * Handle the PreOrder "force deleted" event.
     *
     * @param  \App\Models\PreOrder  $preOrder
     * @return void
     */
    public function forceDeleted(PreOrder $preOrder)
    {
        //
    }
}
