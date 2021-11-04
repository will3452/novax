<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show(Shop $shop)
    {
        $shop->load('services');
        return view('shop_show', compact('shop'));
    }
}
