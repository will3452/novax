<?php

namespace App\Models\Traits;

use App\Models\Wishlist;

trait HasWishlists
{
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'consumer_id');
    }

    public function isInTheList($productId)
    {
        return $this->wishlists()->whereProductId($productId)->exists();
    }

    public function addToWishlist($productId)
    {
        if ($this->isInTheList($productId)) {
            return true;
        }

        return $this->wishlists()->create([
            'product_id' => $productId
        ]);
    }

    public function removeToWishList($productId)
    {
        if (! $this->isInTheList($productId)) {
            return;
        }

        $this->wishlists()
            ->whereProductId($productId)
            ->first()
            ->delete();
    }

    public function clearWishlist()
    {
        $wishlists  = $this->wishlists();
        foreach ($wishlists as $w) {
            $w->delete();
        }
    }
}
