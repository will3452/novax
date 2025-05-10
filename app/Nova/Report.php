<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\GenerateDailySalesReport;
use App\Nova\Actions\GenerateSummaryReport;
use App\Nova\Actions\PaymentSummary;
use App\Nova\Actions\PrintInventory;

class Report extends Resource
{
    public static $group = '4. reports';

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Report::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'created_at',
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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            Text::make('Type')
                ->sortable(),
            Textarea::make('Reason')
                ->showOnIndex(),
            BelongsTo::make('User', 'user', User::class),
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
        return [];
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
        return [
            GenerateDailySalesReport::make()
                ->standalone(),
            GenerateSummaryReport::make()
                ->standalone(),
            PrintInventory::make()
                ->standalone(),
            PaymentSummary::make()
                ->standalone(),
        ];
    }
}
