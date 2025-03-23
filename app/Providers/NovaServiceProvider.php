<?php

namespace App\Providers;

use App\Models\DelayPayment;
use App\Models\Loan;
use Laravel\Nova\Nova;
use App\Models\Payment;
use App\Models\Interest;
use App\Models\MissedPayment;
use App\Models\Penalty;
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
use Coroowicaksono\ChartJsIntegration\AreaChart;
use Coroowicaksono\ChartJsIntegration\BarChart;
use OptimistDigital\NovaSettings\NovaSettings;
use Coroowicaksono\ChartJsIntegration\LineChart;
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
                ],
                'System' => [
                    Boolean::make('Date field', 'show_date_field')
                        ->help('Enable inputting of date upon creation of loan.'),
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
        $missed =  MissedPayment::selectRaw('DATE_FORMAT(due_date, "%Y-%m") as period, COUNT(*) as total')
         ->groupBy('period')
         ->orderBy('period', 'asc')
         ->get();

         $delayGroup =  DelayPayment::whereType('GROUP')->selectRaw('DATE_FORMAT(due_date, "%Y-%m") as period, COUNT(*) as total')
         ->groupBy('period')
         ->orderBy('period', 'asc')
         ->get();

         $delayIndividual =  DelayPayment::whereType('INDIVIDUAL')->selectRaw('DATE_FORMAT(due_date, "%Y-%m") as period, COUNT(*) as total')
         ->groupBy('period')
         ->orderBy('period', 'asc')
         ->get();

         $delay = DelayPayment::selectRaw('DATE_FORMAT(due_date, "%Y-%m") as period, COUNT(*) as total')
         ->groupBy('period')
         ->orderBy('period', 'asc')
         ->get();

         $groupData = [];
         $indData = [];
         foreach ($delay as $key => $value) {
            $groupData[$key] = $delayGroup->first(fn ($item) => $item->period == $value->period)->total ?? 0;
            $indData[$key] =  $delayIndividual->first(fn ($item) => $item->period == $value->period)->total ?? 0;
         }
        return [
            (new LineChart())
                ->title('Missed Payment')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])->series(array([
                    'label' => 'Missed Payment',
                    'borderColor' => '#f7a35c',
                    'data' => $missed->map(function ($e) {
                        return $e->total;
                    }),
                ]))->options([
                    'xaxis' => [
                        'categories' =>  $missed->map(function ($e) {
                            return $e->period;
                        }),
                    ]
                ])->width('1/2'),
            (new LineChart())
                ->title('Late Payment')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series([
                    [
                        'label' => 'Group',
                        'data' => $groupData,
                        'borderColor' => '#dd47',
                    ],
                    [
                        'label' => 'Individual',
                        'data' => $indData,
                        'borderColor' => '#747',
                    ],
                ])->options([
                    'xaxis' => [
                        'categories' =>  $delay->map(function ($e) {
                            return $e->period;
                        }),
                    ]
                ])->width('1/2'),
            (new LineChart())
                ->title('Loan')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->model(Loan::class)
                ->series([
                    [
                        'label' => 'Group',
                        'filter' => [
                            'key' => 'type',
                            'value' => 'GROUP'
                        ],
                    ],
                    [
                        'label' => 'Individual',
                        'filter' => [
                            'key' => 'type',
                            'value' => 'INDIVIDUAL'
                        ],
                    ],
                ])->width('1/2'),
            (new BarChart())
                ->title('Penalties')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->model(Penalty::class)
                ->width('1/2'),
            (new AreaChart())
                ->title('Payment Received')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->model(Payment::class)
                ->width('1/3'),
            LoanTrend::make(),
            LoanDistribution::make(),
            CapitalAmount::make(),
            AmountDisbursed::make(),
            RemainingCapital::make(),
            PaymentReceived::make(),
            TotalRevenue::make(),
            TotalCash::make(),
            // PaymentTrend::make(),
            // SmsCredit::make(),
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
