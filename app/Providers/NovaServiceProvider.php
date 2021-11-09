<?php

namespace App\Providers;

use App\Accounting;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Spatie\BackupTool\BackupTool;
use Illuminate\Support\Facades\Gate;
use Runline\ProfileTool\ProfileTool;
use OptimistDigital\NovaSettings\NovaSettings;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Laravel\Nova\NovaApplicationServiceProvider;
use DigitalCreative\CollapsibleResourceManager\Resources\Group;
use DigitalCreative\CollapsibleResourceManager\Resources\ExternalLink;
use DigitalCreative\CollapsibleResourceManager\Resources\NovaResource;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;

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
            Image::make('Logo')->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN);
            }),
            Text::make('Footer Text')->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN);
            }),
            Text::make('Company Name'),
            Text::make('Address'),
            Text::make('Owner'),
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
            ])->defaultTimezone('Africa/Manila'),
            (new BarChart())
            ->title('Liquidity Ratio')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.4,
                'label' => 'Current Ratio',
                'backgroundColor' => '#2A8192',
                'data' => [abs(Accounting::getCurrentRatio())],
            ],[
                'barPercentage' => 0.4,
                'label' => 'Acid Test Ratio',
                'backgroundColor' => '#1ADCC9',
                'data' => [abs(Accounting::getAcidRatio())],
            ],
            [
                'barPercentage' => 0.4,
                'label' => 'Cash Ratio',
                'backgroundColor' => '#222',
                'data' => [abs(Accounting::getCashRatio())],
            ]))
            ->options([
                'xaxis' => [
                    'categories' => [Accounting::getAccountingPeriodString()]
                ],
            ])
            ->width('1/3'),
            (new BarChart())
            ->title('Profitability Ratio')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.4,
                'label' => 'Return on Assets',
                'backgroundColor' => '#2A8192',
                'data' => [abs(Accounting::getReturnOnAssetsRatio())],
            ],[
                'barPercentage' => 0.4,
                'label' => 'Return on Equity',
                'backgroundColor' => '#1ADCC9',
                'data' => [abs(Accounting::getReturnOnEquity())],
            ]))
            ->options([
                'xaxis' => [
                    'categories' => [Accounting::getAccountingPeriodString()]
                ],
            ])
            ->width('1/3'),

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
            new CollapsibleResourceManager([
                'navigation' => [
                    TopLevelResource::make([
                        'label'=>'RECORD MANAGEMENT',
                        'icon'=>null,
                        'resources'=>[
                            \App\Nova\Asset::class,
                            \App\Nova\Product::class,
                            \App\Nova\StockTake::class,
                            \App\Nova\StockReport::class,
                        ]
                    ])->canSee(function ($request) {
                        return !$request->user()->hasRole(\App\Models\Role::SUPERADMIN);
                    }),
                    TopLevelResource::make([
                        'label'=>'ANALYSIS AND EVALUATION',
                        'icon' => null,
                        'resources'=>[

                            \App\Nova\GeneralJournalRemark::class,
                            ExternalLink::make([
                                'label' => 'T Accounts',
                                'badge' => null,
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>',
                                'target' => '_blank',
                                'url' => '/t-accounts',
                            ]),
                            ExternalLink::make([
                                'label' => 'Trial balance',
                                'badge' => null,
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>',
                                'target' => '_blank',
                                'url' => '/trial-balance',
                            ])
                        ]
                    ])->canSee(function ($request) {
                        return !$request->user()->hasRole(\App\Models\Role::SUPERADMIN);
                    }),
                    TopLevelResource::make([
                        'label'=> 'FINANCIAL STATEMENTS ',
                        'icon'=>null,
                        'resources'=>[
                            ExternalLink::make([
                                'label' => 'Income Statement',
                                'badge' => null,
                                'icon' => null,
                                'target' => '_blank',
                                'url' => '/incoming-statement',
                            ]),
                            ExternalLink::make([
                                'label' => 'Owner’s Equity ',
                                'badge' => null,
                                'icon' => null,
                                'target' => '_blank',
                                'url' => '/owners-equity',
                            ]),
                            ExternalLink::make([
                                'label' => 'Balance Sheet',
                                'badge' => null,
                                'icon' => null,
                                'target' => '_blank',
                                'url' => '/financial-position',
                            ]),
                        ]
                        ])->canSee(function ($request) {
                            return !$request->user()->hasRole(\App\Models\Role::SUPERADMIN);
                        }),
                    TopLevelResource::make([
                        'label'=> 'FINANCIAL RATIO',
                        'icon'=>null,
                        'resources'=>[
                            ExternalLink::make([
                                'label' => 'Liquidity Ratio',
                                'badge' => null,
                                'icon' => null,
                                'target' => '_blank',
                                'url' => '/liquidity-ratio',
                            ]),
                            ExternalLink::make([
                                'label' => 'Profitability  Ratio',
                                'badge' => null,
                                'icon' => null,
                                'target' => '_blank',
                                'url' => '/profitability-ratio',
                            ]),
                        ]
                    ])->canSee(function ($request) {
                        return !$request->user()->hasRole(\App\Models\Role::SUPERADMIN);
                    }),
                    TopLevelResource::make([
                        'label'=> 'Data Setting',
                        'icon'=>null,
                        'resources'=>[
                            \App\Nova\Location::class,
                            \App\Nova\Account::class,
                            \App\Nova\AccountingPeriod::class,
                        ]
                        ])->canSee(function ($request) {
                            return !$request->user()->hasRole(\App\Models\Role::SUPERADMIN);
                        }),
                        TopLevelResource::make([
                            'label'=> 'Access',
                            'icon'=>null,
                            'resources'=>[
                                // \App\Nova\Role::class,
                                \App\Nova\User::class,
                            ]
                            ]),
                ]
                ]),
            new ProfileTool,
            (new BackupTool)->canSee(function ($request) {
                return $request->user()->hasRole(\App\Models\Role::SUPERADMIN);
            }),
            (new NovaSettings),
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
