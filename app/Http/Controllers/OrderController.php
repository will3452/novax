<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\OrderCreatedEvent;

class OrderController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'discount_id' => '', // not secured way
            'mop' => ['required'],
        ]);

        $items = Item::whereUserId(auth()->id())->whereNull('order_id')->get()->all();

        $amount_payable = auth()->user()->total_amount_payable;

        if ($request->discount_id) {
            $discount = Discount::find($request->discount_id);
            $amount_payable = auth()->user()->discountedTotalAmount($discount->rate);
            $discount->update(['credit' => -- $discount->credit]);
        }

        $order = Order::create([
            'ref' => 'OR-' . Str::random(8),
            'discount_id' => $request->discount_id,
            'mop' => $request->mop,
            'user_id' => auth()->id(),
            'delivery_fee' => auth()->user()->delivery_fee ?? 0,
            'items' => json_encode($items),
            'amount_payable' => $amount_payable
        ]);


        event(new OrderCreatedEvent($order));

        alert()->success('Your order has been processed');

        return back();
    }

    public function index(Request $request) {
        $orders = auth()->user()->orders;
        return view('orders.index', compact('orders'));
    }
}
