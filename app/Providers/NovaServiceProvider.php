<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Pdmfc\NovaCards\Info;
use App\Models\Announcement;
use App\Nova\Metrics\Ages;
use App\Nova\Metrics\Genders;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Spatie\BackupTool\BackupTool;
use App\Nova\Metrics\RequestPerDay;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use Elezerk\IsVaccinated\IsVaccinated;
use App\Nova\Metrics\VaccinationSummary;
use App\Nova\Metrics\TotalPendingRequest;
use App\Nova\Metrics\TotalNumberOfRequest;
use OptimistDigital\NovaSettings\NovaSettings;
use App\Nova\Metrics\ResolvedAndPendingRequest;
use App\Nova\Metrics\TotalNumberOfAnnouncement;
use App\Nova\Metrics\TotalNumberOfApprovedUsers;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Metrics\TotalNumberOfUserRequestDocument;
use Elezerk\LatestDocumentRequested\LatestDocumentRequested;

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
                ->rules(['required']),

            Textarea::make('Features')
                ->rules(['required']),

            Text::make('Contacts')
                ->help('please separate contact info thru comma (,)'),

            Image::make('Image 1'),

            Image::make('Image 2'),

            Image::make('Image 3'),

            Image::make('Image 4'),

            Image::make('Image 5'),
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

            // (new IsVaccinated())
            //     ->canSee(function () {
            //         return auth()->user()->not_admin;
            //     }),

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
            (new Ages())
                ->canSee(function () {
                    return ! auth()->user()->not_admin;
                }),
            (new Genders())
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
