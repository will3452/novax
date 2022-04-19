<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\NewProductsHasBeenAdded;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    public function created(Product $product)
    {
        $store = $product->storeOwner;
        $storeFollowers = $store->followers;
        foreach ($storeFollowers as $f) {
            Notification::send($f->follower, new NewProductsHasBeenAdded($store));
        }
    }
}
