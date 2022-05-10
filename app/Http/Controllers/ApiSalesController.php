<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class ApiSalesController extends Controller
{
    public function getSales()
    {
        return auth()->user()->sales;
    }

    public function report(ReportRequest $r)
    {
        $r->validated();

        return OrderProduct::whereStoreId(auth()->id())->whereBetween('created_at', [$r->from, $r->to])->get();
    }

    public function getStoreOrders()
    {
        $orders = OrderProduct::whereStoreId(auth()->id())->get()->groupBy('order_id')->keys()->all();
        return Order::with('pop')->find($orders);
    }
}
