<?php

namespace App\Providers;

use App\Models\User;
use App\Nova\Metrics\ClientPerPackage;
use App\Nova\Metrics\Clients;
use App\Nova\Metrics\Expenses;
use App\Nova\Metrics\Income;
use App\Nova\Metrics\Packages;
use App\Nova\Metrics\Payments;
use ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use OptimistDigital\NovaSettings\NovaSettings;
use Runline\ProfileTool\ProfileTool;
use Spatie\BackupTool\BackupTool;

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
            Textarea::make('About'),
            Textarea::make('Contacts')
                ->help('Please Separated each contact by comma (,)'),
            Textarea::make('Landing Welcome'),
            Code::make('Map'),
            Textarea::make('Landing Greeting', 'landing_greeting'),
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
            (new Clients())->canSee(function () {
                return auth()->user()->type != 'Client';
            }),
            (new Packages())->canSee(function () {
                return auth()->user()->type != 'Client';
            }),
            (new ClientPerPackage())->canSee(function () {
                return auth()->user()->type != 'Client';
            }),
            (new Expenses())->canSee(function () {
                return auth()->user()->type != 'Client';
            }),
            (new Income())->canSee(function () {
                return auth()->user()->type != 'Client';
            }),
            (new Payments())->canSee(function () {
                return auth()->user()->client != null;
            }),
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
            (new ProfileTool)->canSee(function () {
                return config('novax.profile_enabled');
            }),
            (new BackupTool)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.back_up_enabled');
            }),
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->type === User::TYPE_ADMIN &&
                config('novax.setting_enabled');
            }),
            NovaBreadcrumbs::make(),
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
