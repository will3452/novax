<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show (Request $request, Product $product) {
        return view('products.show', compact('product'));
    }

    public function addToCart(Request $request, Product $product) {

        if (auth()->user()->checkInCart($product->id)) {
            alert()->error('Item was already in your cart!');
            return back();
        }

        auth()->user()->addToCart($product->id, $request->quantity ?? 1);

        alert('Item was added!');

        return back();
    }

    public function removeToCart(Request $request, Product $product) {

        if (! auth()->user()->checkInCart($product->id)) {
            alert()->error('Item was not in your cart!');
            return back();
        }

        auth()->user()->removeToCart($product->id, $request->quantity ?? 1);

        alert('Item was removed!');

        return back();
    }

    public function applyDiscount(Request $request) {
        $discount = Discount::whereCode($request->code)->first();

        if (!$discount) {
            alert()->error('Discount code invalid!');
            return back();
        }

        // check user already use the discount code
        $alreadyInUsed = Order::whereDiscountId($discount->id)->whereUserId(auth()->id())->exists();

        if ($alreadyInUsed) {
            alert()->error('Discount invalid!');
            return back();
        }

        alert()->success('Discount applied!');

        return back()->withDiscount($discount);

    }

    public function cart(Request $request) {
        return view('cart');
    }

    public function addToWishlist(Request $request) {
        if (auth()->user()->checkWishlist($request->product_id)) {
            alert()->error('Item is already in your wishlist.');

            return back();
        }

        auth()->user()->addToWishlist($request->product_id);
        alert()->success('Item has been added to your wishlist.');
        return back();
    }

    public function removeToWishlist(Request $request, $product) {
        if (! auth()->user()->checkWishlist($product)) {
            alert()->error('No item found!');

            return back();
        }

        auth()->user()->removeToWishlist($product);
        alert()->success('Item has been removed to your wishlist.');
        return back();
    }

    public function wishlist(Request $request) {
        $list = WishList::whereUserId(auth()->id())->with('product')->get();
        return view('wishlist', compact('list'));
    }
}
