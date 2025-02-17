<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('nonstudent', fn () => ! auth()->user()->isStudent());
        Blade::if('student', fn () => auth()->user()->isStudent());
        Blade::if('admin', fn () => auth()->user()->isAdmin());
        Blade::if('ca', fn () => auth()->user()->isAdmin() || auth()->user()->isCoordinator()); // coor and admin
        Blade::if('coordinator', fn () => auth()->user()->isCoordinator());
    }
}
