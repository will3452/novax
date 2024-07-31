<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\CartItem;
class CartController extends Controller
{
    public function addItem(Request $request) {
        return auth()->user()->cartItems()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    public function removeItem(Request $request, CartItem $cartItem) {
        return $cartItem->delete();
    }

    public function getItems(Request $request) {
        return auth()->user()->cartItems()->whereNull('reference')->get();
    }

    public function updateItem(Request $request, CartItem $cartItem) {
        return $cartItem->update(['quantity' => $request->quantity]);
    }

}
