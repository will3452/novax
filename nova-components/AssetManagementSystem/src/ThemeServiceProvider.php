<?php

namespace Elezerk\AssetManagementSystem;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::booted(function () {
            Nova::theme(asset('/elezerk/asset-management-system/theme.css'));
        });

        $this->publishes([
            __DIR__.'/../resources/css' => public_path('elezerk/asset-management-system'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
