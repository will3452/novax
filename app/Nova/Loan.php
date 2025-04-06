<?php

namespace App\Nova;

use App\Nova\Actions\CreateLoan;
use App\Nova\Metrics\LoanAmount;
use App\Nova\Metrics\TotalPenalties;
use Eminiarts\Tabs\Tabs;
use Str;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;

class Loan extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public static $group = '1_Services';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Loan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Tabs::make('Loan Information', [
                'Details' => [
                    Text::make('Reference')->exceptOnForms()->sortable(),
                    Badge::make('Status', 'payment_status')
                        ->map([
                            'PENDING' => 'warning',
                            'PAID' => 'success',
                            'REJECTED' => 'rejected',
                        ]),
                    Select::make('Type')
                        ->rules(['required'])
                        ->options([
                            'INDIVIDUAL' => 'INDIVIDUAL',
                            'GROUP' => 'GROUP',
                        ]),
                    Date::make('Start Date', 'start_date'),
                    Date::make('End Date')->rules(['required']),
                    Text::make('Duration', function() {
                        $duration = $this->start_date->diffInDays($this->end_date);
                        return "$duration day(s)";
                    }),
                    Text::make('Interest', function () {
                        return "$this->interest %";
                    })->rules(['required']),
                    Hidden::make('Reference', 'reference')
                        ->default(fn () => "L" . Str::random(8)),
                    Currency::make('Amount')->onlyOnForms(),
                    Select::make('Interest')
                        ->onlyOnForms()
                        ->options(fn () => \App\Models\Interest::get()->pluck('name', 'rate')),
                    Select::make('Payment Schedule')
                        ->options([
                            'DAILY' => 'DAILY',
                            'WEEKLY' => 'WEEKLY',
                            'MONTHLY' => 'MONTHLY',
                        ])->rules(['required']),
                    Textarea::make('Collateral'),
                    Image::make('Collateral Image'),
                    Image::make('Agreement', 'agreement_image'),
                        ],

                'Borrower(s)' => [
                    HasMany::make('Borrowers', 'userLoans', UserLoan::class),
                ],
                'Schedules' => [
                    HasMany::make('Schedules', 'schedules', PaymentSchedule::class),
                ],
                'Payments' => [
                    HasMany::make('Payments', 'payments', Payment::class),
                ],
                'Penalties' => [
                    HasMany::make('Penalties', 'penalties', Penalty::class),
                ],
            ])->withToolbar(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new LoanAmount($request->resourceId))->onlyOnDetail(),
            (new TotalPenalties($request->resourceId))->onlyOnDetail(),
            // (new TotalBalance($request->resourceId))->onlyOnDetail(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        if ($request->has('action')) {
            return [
                CreateLoan::make()->standalone(),
                // AddGroup::make(),
                // AddBorrower::make(),
            ];
        }
        return [
            CreateLoan::make()
                ->standalone(),
            // AddGroup::make()
            //     ->canSee(fn () => $this->type == "GROUP"),
            // AddBorrower::make()
            //     ->canSee(fn () => $this->type != "GROUP"),
        ];
    }
}
