<?php

namespace App\Providers;

use App\Nova\Metrics\Appointments;
use App\Nova\Metrics\AppointmentToday;
use App\Nova\Metrics\Records;
use App\Nova\Metrics\Services;
use App\Nova\Metrics\Treatments;
use App\Nova\Metrics\Users;
use Elezerk\Calendar\Calendar;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Nova;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
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
            Tabs::make('Settings', [
                Tab::make('Application', [
                    Text::make('Name'),
                    Image::make('Logo'),
                ]),
                Tab::make('Clinic', [
                    Text::make('Dentist Name', 'doctor_name'),
                    Text::make('Clinic Name', 'clinic'),
                    Textarea::make('About'),
                    Textarea::make('Address'),
                    Text::make('Phone No.', 'contact'),
                ]),
                // Tab::make('Schedule', [
                //     TimeField::make('Opening')->withTwelveHourTime(),
                //     TimeField::make('Closing')->withTwelveHourTime(),
                //     Boolean::make('Monday'),
                //     Boolean::make('Tuesday'),
                //     Boolean::make('Wednesday'),
                //     Boolean::make('Thursday'),
                //     Boolean::make('Friday'),
                //     Boolean::make('Saturday'),
                //     Boolean::make('Sunday'),
                // ]),
            ])->withToolbar(),
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
            return in_array($user->type, ['Administrator', 'Staff']);
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
                'Asia/Manila',
            ])->defaultTimezone('Asia/Manila')
            ->canSee(function () {
                return config('novax.time_enabled');
            }),
            Appointments::make(),
            AppointmentToday::make(),
            // Services::make(),
            Treatments::make(),
            Records::make(),
            Users::make(),
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
            (new Calendar()),
            (new ProfileTool)->canSee(fn () => config('novax.profile_enabled')),
            (new BackupTool)->canSee(fn () => config('novax.back_up_enabled')),
            (new NovaSettings)->canSee(fn () => config('novax.setting_enabled')),
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
