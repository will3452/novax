<?php

namespace App\Nova;

use App\Models\Location;
use App\Models\StockTake;
use App\Nova\Actions\PrintStocksReport;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Filters\Saved\EndDate;
use App\Nova\Filters\Saved\StartDate;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class StockReport extends Resource
{
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

    public function authorizedToView(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\StockTake::class;

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
            Date::make('Saved At', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            BelongsTo::make('Product', 'product', Product::class)
                ->searchable()
                ->rules(['required']),

            Select::make('Location')
                ->rules(['required'])
                ->searchable()
                ->options(function () {
                    return Location::where('user_id', auth()->id())->pluck('name', 'name');
                }),

            Number::make('Initial Number Of Stocks')
                ->rules(['required']),

            Number::make('Current Physical Count')
                ->rules(['required']),

            Number::make('Difference', 'difference')->exceptOnForms(),

            Select::make('Inventory Discrepancy')
                ->options([
                    StockTake::INVENTORY_DESCREPANCY_SHRINKAGE => StockTake::INVENTORY_DESCREPANCY_SHRINKAGE,
                    StockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR =>  StockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR,
                    StockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS => StockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS,
                    StockTake::INVENTORY_DESCREPANCY_MISPLACED => StockTake::INVENTORY_DESCREPANCY_MISPLACED,
                    StockTake::INVENTORY_DESCREPANCY_NONE => StockTake::INVENTORY_DESCREPANCY_NONE
                ])
                ->rules(['required'])

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
            PrintStocksReport::make(),
        ];
    }
}
