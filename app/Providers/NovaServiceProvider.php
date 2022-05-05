<?php

namespace App\Providers;

use App\Models\User;
use Elezerk\Chat\Chat;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use App\Nova\Metrics\NumberOfJobOffers;
use Giuga\LaravelNovaSidebar\NovaSidebar;
use App\Nova\Metrics\NumberOfApplications;
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
            Text::make('Tagline'),
            Text::make('Footer Text'),
            Image::make('Carousel Image 1', 'c1'),
            Image::make('Carousel Image 2', 'c2'),
            Image::make('Carousel Image 3', 'c3')
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
            $acceptedUser = [User::TYPE_EMPLOYER, User::TYPE_ADMIN];
            return in_array($user->type, $acceptedUser);
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
            ])->defaultTimezone('Africa/Manila'),
            NumberOfJobOffers::make(),
            NumberOfApplications::make(),
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
            (new Chat),
            new ProfileTool,
            (new BackupTool)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN);
            }),
            (new NovaSettings)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN);
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
