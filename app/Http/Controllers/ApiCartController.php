<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\ProcessCartToOrderRequest;
use App\Http\Requests\RemoveToCartRequest;
use Illuminate\Http\Request;

class ApiCartController extends Controller
{
    public function getCartItems()
    {
        return auth()->user()->cartItems;
    }

    public function addToCart(AddToCartRequest $r)
    {
        $data = $r->validated();


        auth()->user()->addToCart($data['product_id'], $data['quantity']);
        return $this->getCartItems();
    }

    public function removeToCart(RemoveToCartRequest $r)
    {
        $r->validated();

        auth()->user()->removeToCart($r->product_id);
        return $this->getCartItems();
    }

    public function clearCart()
    {
        auth()->user()->clearCart();
        return $this->getCartItems();
    }

    public function processCartToOrder(ProcessCartToOrderRequest $r)
    {
        $r->validated();

        auth()->user()->processCartToOrder($r->address, $r->remarks);

        return $this->getCartItems();
    }
}
