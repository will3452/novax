<?php

namespace App\Nova;

use App\Models\Location;
use App\Nova\Actions\PrintStocksReport;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Filters\Saved\EndDate;
use App\Nova\Filters\Saved\StartDate;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class StockReport extends Resource
{
    public static function icon()
    {
        return '
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>';
    }
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
        if (request()->has('action')) {
            return true;
        }
        return false;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\StockReport::class;

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

            HasMany::make('Stock Takes', 'stockTakes', StockTake::class),

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
        return [
            StartDate::make(),
            EndDate::make(),
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
            (new DownloadExcel),
        ];
    }
}
