<?php

namespace App\Providers;

use App\Nova\Metrics\ApplicationStatus;
use App\Nova\Metrics\ForApproval;
use App\Nova\Metrics\JobPosts;
use App\Nova\Metrics\MyApplications;
use App\Nova\Metrics\MyStudents;
use App\Nova\Metrics\SubmittedApplications;
use App\Nova\Metrics\Trainees;
use App\Nova\Metrics\UserTypes;
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
                'Africa/Nairobi',
                'America/Mexico_City',
                'Australia/Sydney',
                'Europe/Paris',
                'Asia/Manila',
                'Asia/Tokyo',
            ])->defaultTimezone('Africa/Manila'), 
            JobPosts::make(), 
        ];
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            array_push($cards, MyApplications::make()); 
        }

        if (auth()->user()->type == \App\Models\User::TYPE_COORDINATOR) {
            array_push($cards, MyStudents::make()); 
        }

        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            array_push($cards, UserTypes::make()); 
            array_push($cards, ForApproval::make()); 
        }

        if (auth()->user()->type == \App\Models\User::TYPE_HTE) {
            array_push($cards, SubmittedApplications::make()); 
            array_push($cards, ApplicationStatus::make()); 
            array_push($cards, Trainees::make()); 
        }
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
