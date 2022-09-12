<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function getDiscount(Request $request) {
        if (! $request->has('code')) {
            return back()->withError('Invalid Discount Code!');
        }

        $promo = Promo::whereCode($request->code)->where('expired_at', '>=', now())->first();

        if (!$promo) {
            return back()->withError('Invalid Discount Code!');
        }

        return redirect("/carts?promo_id=$promo->id&promo_discount=$promo->discount_rate&code=$promo->code")->withSuccess('great');
    }
}
