<?php

namespace App\Providers;

use App\Models\Branch;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use App\Nova\Metrics\GroupCounselling;
use App\Nova\Metrics\IndividualCounselling;
use App\Nova\Metrics\TotalNumberOfStudents;
use OptimistDigital\NovaSettings\NovaSettings;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Laravel\Nova\NovaApplicationServiceProvider;
use Yna\NovaSwatches\Swatches;

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

        Nova::style('custom-fields-css', public_path('css/custom.css'));

        NovaSettings::addSettingsFields([
            Image::make('Logo'),
            Text::make('Footer Text'),
            Swatches::make('Sidebar'),
            Swatches::make('Primary'),
            Swatches::make('Primary Dark'),
            Swatches::make('Primary 70'),
            Swatches::make('Primary 50'),
            Swatches::make('Primary 30'),
            Swatches::make('Primary 10'),
            Swatches::make('logo'),
            Swatches::make('sidebar icon')
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
        // sprintf("#%06x", rand(0, 16777215));
        // [
        //     'barPercentage' => 0.5,
        //     'label' => 'Average Sales',
        //     'borderColor' => '#f7a35c',
        //     'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
        // ]
        $branches = Branch::get();
        $series = [];
        foreach($branches as $branch) {
            $items = $branch->counsellings()->whereYear('created_at', date('Y'))->get()->groupBy(function($q){
                return $q->created_at->format('m');
            });

            $data = [];

            for($i = 1; $i <= 12; $i++) {
                $i = $i <= 9 ? "0" . $i : $i;
                $data[] = array_key_exists($i, $items->all()) ? count($items->all()[$i]) : 0;
            }

            $series[] = [
                'barPercentage' => 1,
                'label' => $branch->name,
                'borderColor' => sprintf("#%06x", rand(0, 16777215)),
                'data' => $data,
            ];
        }
        return [
            (new \Richardkeep\NovaTimenow\NovaTimenow)->timezones([
                'Africa/Nairobi',
                'America/Mexico_City',
                'Australia/Sydney',
                'Europe/Paris',
                'Asia/Manila',
                'Asia/Tokyo',
            ])->defaultTimezone('Africa/Manila'),

            (new GroupCounselling()),

            (new IndividualCounselling()),

            (new TotalNumberOfStudents()),

            (new LineChart())
                ->title('Stat')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series($series)
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ]
                    ],
                ])
    ->width('2/3'),

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
