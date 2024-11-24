<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\PreOrder;
use App\Observers\OrderObserver;
use App\Models\IngredientInventory;
use App\Observers\PreOrderObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\IngredientInventoryObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        IngredientInventory::observe(IngredientInventoryObserver::class);
        Order::observe(OrderObserver::class);
        PreOrder::observe(PreOrderObserver::class);
    }
}
