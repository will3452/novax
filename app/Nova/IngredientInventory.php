<?php

namespace App\Nova;

use App\Nova\Filters\DateFilter;
use App\Nova\Filters\IngredientFilter;
use App\Nova\Metrics\IngredientInventoryTransactions;
use App\Nova\Metrics\UsageAndPurchase;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class IngredientInventory extends Resource
{
    public static $group = 'Inventory';
    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, ['administrator', 'inventory manager']);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\IngredientInventory::class;

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
                ->sortable(),
            BelongsTo::make('Ingredient', 'ingredient', Ingredient::class),
            Select::make('Transaction', 'type')
                ->options([
                    'PURCHASE' => 'PURCHASE',
                    'USAGE' => 'USAGE',
                ]),
            Number::make('Quantity (kg)', 'quantity'),
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
            // UsageAndPurchase::make(),
            // IngredientInventoryTransactions::make(),
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
            DateFilter::make(),
            IngredientFilter::make(),
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
            new DownloadExcel(),
        ];
    }
}
