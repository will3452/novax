<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\User;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use Jubeki\Nova\Cards\Linkable\Linkable;
use Jubeki\Nova\Cards\Linkable\LinkableAway;
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
            (new LinkableAway)
            ->canSee(function () {
                return auth()->user()->type != 'Admin';
            })
            ->title('Shop now')
            ->url('/')
            ->subtitle('go to shop now'),
            (new LinkableAway)
            ->canSee(function () {
                return auth()->user()->type != 'Admin';
            })
            ->title('My Cart')
            ->url('/carts')
            ->subtitle(CartItem::whereUserId(auth()->id())->count()),
            (new LinkableAway)
            ->canSee(function () {
                return auth()->user()->type != 'Admin';
            })
            ->title('My Orders')
            ->url('/orders')
            ->subtitle(Order::whereNotNull('paid_at')->whereUserId(auth()->id())->count()),
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
                return $request->user()->type === User::TYPE_ADMIN &&
                config('novax.back_up_enabled');
            }),
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->type === User::TYPE_ADMIN &&
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
