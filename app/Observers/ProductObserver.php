<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewProductsHasBeenAdded;
use App\Notifications\YourProductCountIsAlreadyLow;

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

    public function updated(Product $p)
    {
        if ($p->quantity <= 5) {
            $p->storeOwner->notify(new YourProductCountIsAlreadyLow($p));
        }
    }
}
