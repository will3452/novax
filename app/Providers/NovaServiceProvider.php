<?php

namespace App\Providers;

use App\Nova\Metrics\Bookings;
use App\Nova\Metrics\BookingStatus;
use App\Nova\Metrics\BookingTrends;
use App\Nova\Metrics\ForApprovalBookings;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\PatientBookingStatus;
use App\Nova\Metrics\ScheduledBookingsToday;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use OptimistDigital\NovaSettings\NovaSettings;
use Laravel\Nova\NovaApplicationServiceProvider;

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
            return true; 
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array`
     */
    protected function cards()
    {
        $cards = [
            (new \Richardkeep\NovaTimenow\NovaTimenow)->timezones([
                'Asia/Manila',
            ])->defaultTimezone('Africa/Manila'),
            ]; 
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            array_push($cards, Bookings::make());
            array_push($cards, BookingTrends::make());
            array_push($cards, BookingStatus::make());

            return $cards; 
        }

        // if (auth()->user()->type == \App\Models\User::TYPE_STAFF) {
            
        // }

        array_push($cards, ForApprovalBookings::make());
        array_push($cards, PatientBookingStatus::make());
        array_push($cards, NewUsers::make()); 
        array_push($cards, ScheduledBookingsToday::make()); 
        return $cards;
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new ProfileTool)->canSee(function () {
                return config('novax.profile_enabled');
            }),
            (new BackupTool)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.back_up_enabled');
            }),
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
