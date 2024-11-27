<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use App\Nova\Filters\DateFilter;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Filters\IngredientFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class IngredientPurchaseOrder extends Resource
{

    public static $group = 'Inventory';
    public static function availableForNavigation(Request $request)
    {

        return false;
        return in_array(auth()->user()->type, ['administrator', 'inventory manager']);
    }

    public static $searchable = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\IngredientPurchaseOrder::class;

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
            ->default(fn () => now())
            ->sortable(),
            BelongsTo::make('Ingredient', 'ingredient', Ingredient::class),
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
        return [];
    }
}
