<?php

namespace App\Providers;

use App\Models\Interest;
use Laravel\Nova\Nova;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Elezerk\LoanForm\LoanForm;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\LoanTrend;
use App\Nova\Metrics\SmsCredit;
use App\Nova\Metrics\TotalCash;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Spatie\BackupTool\BackupTool;
use App\Nova\Metrics\PaymentTrend;
use App\Nova\Metrics\TotalRevenue;
use App\Nova\Metrics\CapitalAmount;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use App\Nova\Metrics\AmountDisbursed;
use App\Nova\Metrics\PaymentReceived;
use App\Nova\Metrics\LoanDistribution;
use App\Nova\Metrics\RemainingCapital;
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
                // 'Application' => [
                //     Image::make('Logo'),
                //     Textarea::make('Mission'),
                //     Textarea::make('Vision'),
                // ],
                'Finance' => [
                    // Currency::make('Capital Amount'),
                    Currency::make('Max Loan'),
                    Currency::make('Minimum Loan'),
                ],
                'Notification' => [
                    // Text::make('Semaphore API Key', 'sms_key'),
                    Boolean::make('Remind borrowers for their upcoming due?', 'reminder'),
                    Textarea::make('Reminder Template Message', 'sms_template')->rules(['max:160'])->help('max characters length is 160 only.'),
                ]
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
            CapitalAmount::make(),
            AmountDisbursed::make(),
            RemainingCapital::make(),
            PaymentReceived::make(),
            TotalRevenue::make(),
            TotalCash::make(),
            // PaymentTrend::make(),
            LoanTrend::make(),
            LoanDistribution::make(),
            SmsCredit::make(),
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
            (new ProfileTool)->canSee(fn () => config('novax.profile_enabled')),
            (new LoanForm()),
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
