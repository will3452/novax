<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function getOrders()
    {
        return auth()->user()->orders;
    }
}
