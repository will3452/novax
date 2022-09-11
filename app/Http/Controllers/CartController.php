<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function toggleCart ($productId, $qty, $method = 'POST') {
        $cartItem = CartItem::where('product_id', $productId)->where('user_id', auth()->id())->exists();
        if ($cartItem && $method == 'POST') {
            return CartItem::where('product_id', $productId)->where('user_id', auth()->id())->delete();
        }

        $data = [
            'user_id' => auth()->id(),
            'quantity' => $qty,
            'product_id' => $productId,
        ];

        if ($method == "POST")
            return CartItem::create($data);

        return CartItem::where('product_id', $productId)->where('user_id', auth()->id())->update($data);
    }

    public function addToCart (Request $request, $id) {
        $this->toggleCart($id, $request->quantity);
        return back();
    }

    public function removeToCart(Request $request, $id) {
        $this->toggleCart($id, $request->quantity);
        return back();
    }

    public function index () {
        $items = auth()->user()->cartItems;
        return view('cart', compact('items'));
    }
}
