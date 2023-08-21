<?php

namespace App\Providers;

use App\Nova\Metrics\Bookings;
use App\Nova\Metrics\BookingTrend;
use App\Nova\Metrics\Buses;
use App\Nova\Metrics\Profiles;
use App\Nova\Metrics\Terminals;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use OptimistDigital\NovaSettings\NovaSettings;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        NovaSettings::addSettingsFields([
            Image::make('Logo'),
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array`
     */
    protected function cards()
    {
        return [
            (new \Richardkeep\NovaTimenow\NovaTimenow)->timezones([
                'Africa/Nairobi',
                'America/Mexico_City',
                'Australia/Sydney',
                'Europe/Paris',
                'Asia/Manila',
                'Asia/Tokyo',
            ])->defaultTimezone('Africa/Manila')
                ->canSee(function () {
                    return config('novax.time_enabled');
                }),
            Profiles::make(),
            Bookings::make(),
            Buses::make(),
            Terminals::make(),
            BookingTrend::make(),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.setting_enabled');
            }),
        ];
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
