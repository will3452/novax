<?php

namespace App\Providers;

use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\PurchaseOrderItem;
use App\Models\SaleItem;
use App\Models\SupplierBill;
use App\Models\SupplierPayment;
use App\Observers\InventoryObserver;
use App\Observers\OrderItemObserver;
use App\Observers\PurchaseOrderItemObserver;
use App\Observers\SaleItemObserver;
use App\Observers\SupplierBillObserver;
use App\Observers\SupplierPaymentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        PurchaseOrderItem::observe(PurchaseOrderItemObserver::class);
        SaleItem::observe(SaleItemObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        SupplierPayment::observe(SupplierPaymentObserver::class);
        SupplierBill::observe(SupplierBillObserver::class);
        Inventory::observe(InventoryObserver::class);
    }
}
