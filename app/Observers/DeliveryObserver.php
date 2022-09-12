<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Delivery;

class DeliveryObserver
{
    public function creating (Delivery $delivery) {
        if ($delivery->address == null) {
            $order = Order::find($delivery->order_id);
            $address = $order->user->address;
            $delivery->address = $address;
        }
    }
}
