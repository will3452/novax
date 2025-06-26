<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Branch;
use App\Models\PaymentMethod;
use App\Nova\Dashboards\BranchDashboard;
use App\Nova\Dashboards\CostDashboard;
use App\Nova\Dashboards\PaymentDashboard;
use App\Nova\Dashboards\SalesDashboard;
use App\Nova\Metrics\BranchDailyExpenses;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use App\Nova\Metrics\Expenses;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\Suppliers;
use App\Nova\Metrics\OutOfStocks;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use App\Nova\Metrics\BranchDailySales;
use App\Nova\Metrics\DailyBranchCost;
use App\Nova\Metrics\OutOfStocksPerBranch;
use App\Nova\Metrics\PaymentPerPaymentMethod;
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
            // return in_array($user->email, [
            //     'root@yopmail.com'
            // ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array`
     */
    protected function cards()
    {
        $branches = auth()->user()->role == \App\Models\User::ROLE_ADMIN ? Branch::get() : auth()->user()->branches;
        $cards = [
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
            OutOfStocksPerBranch::make(),
            // Expenses::make(),
        ];

        return $cards;
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new CostDashboard(),
            new SalesDashboard(),
            // new PaymentDashboard(),
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
            (new ProfileTool)->canSee(fn () => config('novax.profile_enabled')),
            (new BackupTool)->canSee(fn () => config('novax.back_up_enabled')),
            (new NovaSettings)->canSee(fn () => auth()->user()->role == User::ROLE_ADMIN),
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
