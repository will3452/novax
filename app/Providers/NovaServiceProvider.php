<?php

namespace App\Providers;

use Bolechen\NovaActivitylog\NovaActivitylog;
use ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs;
use Elezerk\Expensesdashboard\Expensesdashboard;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use OptimistDigital\NovaSettings\NovaSettings;
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
        return [
            Expensesdashboard::make(),
            // (new \Richardkeep\NovaTimenow\NovaTimenow)->timezones([
            //     'Africa/Nairobi',
            //     'America/Mexico_City',
            //     'Australia/Sydney',
            //     'Europe/Paris',
            //     'Asia/Manila',
            //     'Asia/Tokyo',
            // ])->defaultTimezone('Africa/Manila'),
            // Users::make(),
            // Projects::make(),
            // ProjectPerCategory::make(),
            // Expenses::make(),
            // ExpensesPerDay::make(),
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

            NovaBreadcrumbs::make(),
            (new NovaActivitylog())->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.setting_enabled');
            }),
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN) &&
                config('novax.setting_enabled');
            }),
            // BackupTool::make(), 
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
