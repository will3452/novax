<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::with('products')->paginate(10); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = CartItem::whereUserId(auth()->id())->with('product')->get(); 
        $reference = \Str::random(); 
        $total_amount = 0; 

        foreach($items as $item) {
            $total_amount += ($item->product->price * $item->qty); 
        }

        $order = Order::create([
            'user_id' => auth()->id(), 
            'total_amount' => $total_amount, 
            'reference' => $reference, 
            'mop' => 'OVER-THE-COUNTER', 
        ]);
        
        foreach($items as $item) {
            OrderItem::create([
                'product_id' => $item->product_id, 
                'qty' => $item->qty, 
                'order_id' => $order->id, 
                'total_amount' => ($item->product->price * $item->qty), 
            ]); 
        }

        CartItem::whereUserId(auth()->id())->with('product')->delete(); // clean cart

        return $order; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
