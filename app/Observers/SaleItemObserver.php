<?php

namespace App\Observers;

use App\Models\Sale;
use App\Models\SaleItem;

class SaleItemObserver
{
    /**
     * Handle the SaleItem "created" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function created(SaleItem $saleItem)
    {
        $s = Sale::find($saleItem->sale_id);
        $total_amount = 0;
        $si = SaleItem::where([
            'sale_id' => $saleItem->sale_id,
        ])->get();

        foreach ($si as $i) {
            $total_amount += ($i->price * $i->qty);
        }

        $s->update(['total_amount' => $total_amount]);
    }

    /**
     * Handle the SaleItem "updated" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function updated(SaleItem $saleItem)
    {
        //
    }

    /**
     * Handle the SaleItem "deleted" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function deleted(SaleItem $saleItem)
    {
        $s = Sale::find($saleItem->sale_id);
        $total_amount = 0;
        $si = SaleItem::where([
            'sale_id' => $saleItem->sale_id,
        ])->get();

        foreach ($si as $i) {
            $total_amount += ($i->price * $i->qty);
        }

        $s->update(['total_amount' => $total_amount]);
    }

    /**
     * Handle the SaleItem "restored" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function restored(SaleItem $saleItem)
    {
        //
    }

    /**
     * Handle the SaleItem "force deleted" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function forceDeleted(SaleItem $saleItem)
    {
        //
    }
}
