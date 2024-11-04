<?php

namespace App\Nova;

use App\Nova\Actions\ViewUsageAnalytic;
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
        'name',
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
            Number::make('Actual Stocks(kg)', 'current_qty')->sortable()->exceptOnForms(),
            Number::make('Outstanding P.O', 'opo')->sortable()->exceptOnForms(),
            Number::make('Total Purchase(kg)', 'tp')->sortable()->exceptOnForms(),
            Number::make('Total Usage(kg)', 'tu')->sortable()->exceptOnForms(),
            Number::make('Daily Usage(avg.)', 'td')->sortable()->exceptOnForms(),
            Number::make('Days to Last', 'dl')->sortable()->exceptOnForms(),
            // Number::make('Outstanding P.O', fn () => $this->purchaseOrders()->sum('quantity') - $this->quantity),
            // Number::make('Total Purchase(kg)', fn () => $this->purchaseOrders()->sum('quantity')),
            // Number::make('Total Usage(kg)', fn () => $this->inventories()->whereType('Usage')->sum('quantity')),
            // Number::make('Daily Usage(avg.)', fn () => $this->inventories()->whereType('Usage')->avg('quantity')),
            Text::make('Status', function () {
                // $totalUsage = $this->inventories()->whereType('Usage')->avg('quantity');
                // $result = 0;
                // if ($totalUsage != 0) {
                //     $result = $this->current_qty / $this->inventories()->whereType('Usage')->avg('quantity');
                // }

                $result = $this->dl;
                $color = 'green';
                if ($this->type == "MACRO" && $result <= 5) {
                    $color = 'red';
                }
                if ($this->type == "MICRO" && $result <= 15) {
                    $color = 'red';
                }
                return "<span style='display:block; width:20px; height:20px;background:$color;padding:4px 4px; border-radius:10px;'></span>";
            })
                ->asHtml(),
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
            ViewUsageAnalytic::make()->standalone(),
            new DownloadExcel()
        ];
    }
}
