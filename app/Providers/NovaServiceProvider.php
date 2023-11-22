<?php

namespace App\Providers;

use Elezerk\CurrentBalance\CurrentBalance;
use Elezerk\QrGenerator\QrGenerator;
use Laravel\Nova\Nova;
use Laravel\Nova\Fields\Text;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Currency;
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
            Text::make('GCASH API KEY', 'gcash_api'),
            Text::make('Footer'),
            Text::make('Regular Fare', 'reg_fare')->default(fn () => 11), 
            Text::make('Additional Fare', 'ad_fare')
                ->help('For Every succeeding Kilometer. ')
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
            (new CurrentBalance())->withMeta(['balance' => auth()->user()->balance, 'postUrl' => '/api/load', 'userId' => auth()->id()]),
            (new QrGenerator())->withMeta(['user_id' => auth()->id(), 'ads_fare' => auth()->user()->current_fare, 'status' => auth()->user()->status]),
            (new \Richardkeep\NovaTimenow\NovaTimenow)->timezones([
                'Africa/Nairobi',
                'America/Mexico_City',
                'Australia/Sydney',
                'Europe/Paris',
                'Asia/Manila',
                'Asia/Tokyo',
            ])->defaultTimezone('Africa/Manila'), 
        ];
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
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->email == 'super@admin.com';
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
