<?php

namespace App\Nova;

use App\Models\Location;
use App\Models\StockTake as ModelsStockTake;
use App\Nova\Filters\Saved\EndDate;
use App\Nova\Filters\Saved\StartDate;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class StockTake extends Resource
{
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
                    ModelsStockTake::INVENTORY_DESCREPANCY_SHRINKAGE => ModelsStockTake::INVENTORY_DESCREPANCY_SHRINKAGE,
                    ModelsStockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR =>  ModelsStockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR,
                    ModelsStockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS => ModelsStockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS,
                    ModelsStockTake::INVENTORY_DESCREPANCY_MISPLACED => ModelsStockTake::INVENTORY_DESCREPANCY_MISPLACED,
                    ModelsStockTake::INVENTORY_DESCREPANCY_NONE => ModelsStockTake::INVENTORY_DESCREPANCY_NONE
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
        ];
    }
}
