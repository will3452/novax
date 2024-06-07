<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use App\Nova\Metrics\Tasks;
use App\Nova\Metrics\Users;
use App\Nova\Metrics\Groups;
use App\Nova\Metrics\Titles;
use Laravel\Nova\Cards\Help;
use App\Nova\Metrics\Courses;
use Laravel\Nova\Fields\Text;
use App\Nova\Metrics\NewUsers;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\NewGroups;
use App\Nova\Metrics\NewTitles;
use Laravel\Nova\Fields\Select;
use App\Nova\Metrics\MySections;
use Spatie\BackupTool\BackupTool;
use App\Nova\Metrics\GroupsBelong;
use App\Nova\Metrics\Announcements;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use App\Nova\Metrics\TitleApplications;
use Czemu\NovaCalendarTool\NovaCalendarTool;
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
            Select::make('Coordinator', 'coordinator_id')
                ->help('Select from faculty.')
                ->options(\App\Models\User::whereType(\App\Models\User::TYPE_FACULTY)->get()->pluck('name', 'id')), 
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
                'Asia/Manila',
            ]),
            Tasks::make(), 
        ]; 

        if (auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR) {
            array_push($cards, Users::make());
            array_push($cards, Groups::make());
            array_push($cards, Titles::make());
            array_push($cards, Announcements::make());
            array_push($cards, Courses::make());
            array_push($cards, NewGroups::make());
            array_push($cards, NewTitles::make());
            array_push($cards, NewUsers::make());
        }

        if (auth()->user()->type == \App\Models\User::TYPE_STUDENT) {
            array_push($cards, GroupsBelong::make()); 
            array_push($cards, MySections::make()); 
            array_push($cards, TitleApplications::make()); 
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
            (new ProfileTool)->canSee(function ($request) {
                return config('novax.profile_enabled') && $request->user()->email != 'super@admin.com'; // to prevent changing of password 
            }),
            (new NovaCalendarTool)->canSee(function ($request) {
                return $request->user()->id == nova_get_setting('coordinator_id'); 
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
