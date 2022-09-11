<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index () {
        $orders = Order::whereNotNull('paid_at')->whereUserId(auth()->id())->get();
        return view('order', compact('orders'));
    }
}
