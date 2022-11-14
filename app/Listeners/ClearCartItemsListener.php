<?php

namespace App\Listeners;

use App\Models\Item;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearCartItemsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        Item::whereNull('order_id')->whereUserId(auth()->id())->update(['order_id' => $order->id]);
    }
}
