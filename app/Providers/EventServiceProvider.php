<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\FareMatrix;
use App\Observers\BookingObserver;
use App\Observers\FareMatrixObserver;
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
        //
        FareMatrix::observe(FareMatrixObserver::class); 
        Booking::observe(BookingObserver::class); 
    }
}
