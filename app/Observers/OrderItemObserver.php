<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemObserver
{
    /**
     * Handle the OrderItem "created" event.
     *
     * @param  \App\Models\OrderItem  $OrderItem
     * @return void
     */
    public function created(OrderItem $OrderItem)
    {
        $s = Order::find($OrderItem->order_id);
        $total_amount = 0;
        $si = OrderItem::where([
            'order_id' => $OrderItem->order_id,
        ])->get();

        foreach ($si as $i) {
            $total_amount += ($i->price * $i->qty);
        }

        $s->update(['total_amount' => $total_amount]);
    }

    /**
     * Handle the OrderItem "updated" event.
     *
     * @param  \App\Models\OrderItem  $OrderItem
     * @return void
     */
    public function updated(OrderItem $OrderItem)
    {
        //
    }

    /**
     * Handle the OrderItem "deleted" event.
     *
     * @param  \App\Models\OrderItem  $OrderItem
     * @return void
     */
    public function deleted(OrderItem $OrderItem)
    {
        $s = Order::find($OrderItem->order_id);
        $total_amount = 0;
        $si = OrderItem::where([
            'order_id' => $OrderItem->order_id,
        ])->get();

        foreach ($si as $i) {
            $total_amount += ($i->price * $i->qty);
        }

        $s->update(['total_amount' => $total_amount]);
    }

    /**
     * Handle the OrderItem "restored" event.
     *
     * @param  \App\Models\OrderItem  $OrderItem
     * @return void
     */
    public function restored(OrderItem $OrderItem)
    {
        //
    }

    /**
     * Handle the OrderItem "force deleted" event.
     *
     * @param  \App\Models\OrderItem  $OrderItem
     * @return void
     */
    public function forceDeleted(OrderItem $OrderItem)
    {
        //
    }
}
