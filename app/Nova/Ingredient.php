<?php

namespace App\Nova;

use App\Nova\Metrics\MacroAndMicro;
use App\Nova\Metrics\NewIngredients;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Ingredient extends Resource
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
    public static $model = \App\Models\Ingredient::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title () {
        return "$this->name ($this->type)";
    }

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
            Text::make('Name')
                ->rules(['required']),
            Select::make('Type')
                ->options([
                    'MACRO' => 'MACRO',
                    'MICRO' => 'MICRO',
                ]),
            // Number::make('Bag')->default(fn () => 1),
            // Number::make('Kg')->default(fn () => 1),
            // Currency::make('Unit Price', 'price'),
            Number::make('Actual Stocks(kg)', fn () => $this->quantity),
            Number::make('Total Purchase(kg', fn () => $this->purchaseOrders()->sum('quantity')),
            Number::make('Outstanding P.O', fn () => $this->purchaseOrders()->sum('quantity') - $this->quantity),
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
            // MacroAndMicro::make(),
            // NewIngredients::make(),
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
        return [
            new DownloadExcel()
        ];
    }
}
