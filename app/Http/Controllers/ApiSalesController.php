<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiSalesController extends Controller
{
    public function getSales()
    {
        return auth()->user()->sales;
    }
}
