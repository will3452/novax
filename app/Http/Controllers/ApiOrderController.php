<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkAsRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function getOrders()
    {
        return auth()->user()->orders;
    }

    public function markAsCompleted(MarkAsRequest $r)
    {
        $r->validated();
        Order::find($r)->markAs(Order::STATUS_COMPLETED);
        return $this->getOrders();
    }
}
