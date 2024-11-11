<?php

namespace App\Nova;

use App\Nova\Actions\PayNow;
use App\Nova\Actions\SendDueTodayReminder;
use App\Nova\Filters\FilterByDate;
use App\Nova\Metrics\DueToday;
use App\Nova\Lenses\DueToday as DueTodayLens;
use App\Nova\Metrics\DueTodayStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PaymentSchedule extends Resource
{
    public static $group = '1_Services';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PaymentSchedule::class;


    public function title () {
        return $this->due_date->format('m/d/Y');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'due_date',
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
            Date::make('Due Date'),
            Text::make('Amount'),
            BelongsTo::make('Loan', 'loan', Loan::class),
            Badge::make('Status')
                ->map([
                    'PAID' => 'success',
                    'PENDING' => 'info',
                ]),
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
            new DueToday(),
            new DueTodayStatus(),
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
        return [
            FilterByDate::make('due_date'),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            DueTodayLens::make(),
        ];
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
                PayNow::make()->showOnTableRow(),
                SendDueTodayReminder::make()->standalone(),
            ];
        }
        return [
            PayNow::make()->showOnTableRow()->canSee(fn () => $this->status == 'PENDING'),
            SendDueTodayReminder::make()->standalone(),
        ];
    }
}
