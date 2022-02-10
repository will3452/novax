<?php

namespace App\Providers;

use App\Models\Role;
use Laravel\Nova\Nova;
use Pdmfc\NovaCards\Info;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
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
            Image::make('Logo'),
            Number::make('Maximum Account Per Scholar', 'max_account')
                ->default(fn () => 3),
            Textarea::make('Copyright Disclaimer')
                ->default(fn () => 'I certify that I own the copyright and have obtained written approval for use of all the materials under my name and account, and hold BRUMULTIVERSE free of liabilities should any copyright infringement occurs.'),
            Number::make('Registration Age Restriction', 'registration_age_restriction'),
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
            (new Info())
                ->warning('
                <div class="flex justify-between w-full items-center">
                    Please verify your email address.
                    <a href="/send-email-verification-notification" class="block ml-2 underline dim text-primary font-bold">Send Verification</a>
                </div>
                ')
                ->asHtml()
                ->canSee(fn () =>
                    ! optional(auth()->user())->hasRole(Role::SUPERADMIN) &&
                    ! optional(auth()->user())->hasVerifiedEmail()
                ),
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
