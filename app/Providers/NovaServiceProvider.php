<?php

namespace App\Providers;

use Elezerk\Chat\Chat;
use Laravel\Nova\Nova;
use Laravel\Nova\Panel;
use App\Nova\Metrics\User;
use Laravel\Nova\Cards\Help;
use App\Nova\Metrics\Symptom;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\Diagnosis;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use Radwanic\ResourceListing\ResourceListing;
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
            new Panel('Application Setting', [
                Text::make('App Name')->rules(['required']),
                Text::make('GCASH API key')->rules(['required']),
                Image::make('Logo'),
            ]),

            new Panel('Landing Page', [
                Textarea::make('Introduction'),
                Text::make('Youtube Introduction Link'),
            ]),

            new Panel('Administrator', [
                Text::make('Admin Email')->rules(['required']),
                Text::make('Admin Mobile')->rules(['required']),
                Currency::make('Appointment Fee')
            ]),
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
            (new User()),
            (new ResourceListing())
                ->cardTitle('New Appointments')
                ->orderBy('updated_at')
                ->readableDate(true)
                ->limit(5)
                ->resource(\App\Models\Appointment::class)
                ->resourceUri('/resources/appointments/')
                ->resourceTitleColumn('user_name'),
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
