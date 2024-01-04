<?php

namespace App\Nova;

use App\Models\Location;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Filters\Saved\EndDate;
use App\Nova\Filters\Saved\StartDate;
use App\Nova\Actions\PrintStocksReport;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\StockTake as ModelsStockTake;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class StockTake extends Resource
{
    public static function icon()
    {
        return '
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>';
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
    public static $title = 'created_at';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'created_at',
        'location',
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
                ->searchable()
                ->options(function () {
                    return Location::get()->pluck('name', 'name');
                }),

            Number::make('Initial Number Of Stocks')
                ->rules(['required']),

            Number::make('Current Physical Count')
                ->rules([]),

            Number::make('Difference', 'difference')->exceptOnForms(),

            Select::make('Inventory Discrepancy')
                ->options([
                    ModelsStockTake::INVENTORY_DESCREPANCY_SHRINKAGE => ModelsStockTake::INVENTORY_DESCREPANCY_SHRINKAGE,
                    ModelsStockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR =>  ModelsStockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR,
                    ModelsStockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS => ModelsStockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS,
                    ModelsStockTake::INVENTORY_DESCREPANCY_MISPLACED => ModelsStockTake::INVENTORY_DESCREPANCY_MISPLACED,
                    ModelsStockTake::INVENTORY_DESCREPANCY_NONE => ModelsStockTake::INVENTORY_DESCREPANCY_NONE
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
