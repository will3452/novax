<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Nova\Metrics\RequestPerDay;
use App\Nova\Metrics\ResolvedAndPendingRequest;
use App\Nova\Metrics\TotalNumberOfAnnouncement;
use App\Nova\Metrics\TotalNumberOfRequest;
use App\Nova\Metrics\TotalNumberOfApprovedUsers;
use App\Nova\Metrics\TotalNumberOfUserRequestDocument;
use App\Nova\Metrics\TotalPendingRequest;
use App\Nova\Metrics\VaccinationSummary;
use Elezerk\LatestDocumentRequested\LatestDocumentRequested;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use OptimistDigital\NovaSettings\NovaSettings;
use Laravel\Nova\NovaApplicationServiceProvider;
use Pdmfc\NovaCards\Info;

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
            Text::make('Gcash Number')
                ->rules(['required']),
            Text::make('Barangay Name')
                ->rules(['required']),
            Text::make('Barangay Address')
                ->rules(['required'])
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
            (new TotalNumberOfRequest())
                ->canSee(function () {
                    return auth()->user()->not_admin;
                }),
            (new TotalPendingRequest())
                ->canSee(function () {
                    return auth()->user()->not_admin;
                }),
            (new LatestDocumentRequested())
                ->canSee(function () {
                    return auth()->user()->not_admin;
                }),
            (new TotalNumberOfAnnouncement())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),
            (new TotalNumberOfApprovedUsers())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),
            (new RequestPerDay())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),
            (new TotalNumberOfUserRequestDocument())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),
            (new ResolvedAndPendingRequest())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),
            (new VaccinationSummary())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),

        ];

        $announcements = Announcement::latest()->get();

        if ( auth()->user()->not_admin && auth()->user()->approved_at === null )
        {
            $cards[] = (new Info())
            ->warning('You must first be approved, to make a document request.');
        }

        if ($announcements && auth()->user()->not_admin)
        {
            foreach ($announcements as $a) {
                $message = "$a->title - $a->body";
                $cards[] = (new Info())
                    ->info($message);
            }
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
