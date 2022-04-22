<?php

namespace App\Providers;

use App\Models\User;
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
        Blade::if('teacher', function () {
            return auth()->user()->type === User::TYPE_TEACHER;
        });

        Blade::if('admin', function () {
            return auth()->check() && optional(auth()->user())->isAdmin();
        });
    }
}
