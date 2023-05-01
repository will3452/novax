<?php

namespace App\Providers;

use App\Models\User;
use App\Nova\Metrics\Faculties;
use App\Nova\Metrics\Students;
use App\Nova\Metrics\Subjects;
use App\Nova\Metrics\TotalSections;
use App\Nova\Metrics\Users;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Nsct\ImportAndExport\ImportAndExport;
use Nsct\Sections\Sections;
use OptimistDigital\NovaSettings\NovaSettings;
use Spatie\BackupTool\BackupTool;

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
        if (auth()->user()->type == User::TYPE_ADMIN) {
            return [
                Users::make(),
                Subjects::make(),
                TotalSections::make(),
                Faculties::make(),
                Students::make(),
            ];
        }
        return [];
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
        if (auth()->user()->type == User::TYPE_TEACHER) {
            return [
                Sections::make(),
                ImportAndExport::make(),
            ];
        }
        return [
            (new BackupTool)->canSee(function ($request) {
                return config('novax.back_up_enabled');
            }),
            (new NovaSettings)->canSee(function ($request) {
                return config('novax.setting_enabled') && auth()->id() == 1;
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
