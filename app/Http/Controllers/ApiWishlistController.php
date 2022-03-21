<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishlistRequest;
use App\Http\Requests\RemoveWishListRequest;
use Illuminate\Http\Request;

class ApiWishlistController extends Controller
{
    public function getWishlist()
    {
        return auth()->user()->wishlists();
    }

    public function removeWishlist(RemoveWishListRequest $r)
    {
        $r->validated();
        auth()->user()->removeToWishList($r->product_id);
        return $this->getWishlist();
    }

    public function addToWishlist(AddToWishlistRequest $r)
    {
        $r->validated();
        auth()->user()->addToWishlist($r->product_id);
        return $this->getWishlist();
    }

    public function clearWishlist()
    {
        auth()->user()->clearWishlist();
        return $this->getWishlist();
    }
}
