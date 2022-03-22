<?php

namespace App\Nova;

use App\Models\Category;
use App\Nova\Actions\NewAdjustment;
use App\Nova\Filters\FilterByQuantity;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'description';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'sku',
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
            Date::make('Added At', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            Text::make('Description')
                ->help('name/brand of product.')
                ->sortable()
                ->rules(['required']),

            Select::make('Category')
                ->options(Category::get()->pluck('description', 'description'))
                ->rules(['required'])
                ->searchable()
                ->sortable(),

            Select::make('UoM', 'uom')
                ->options([
                    'pc' => 'pc'
                ])
                ->rules(['required']),

            Currency::make('Price')
                ->sortable()
                ->rules(['required']),


            Text::make('Stock-Keeping Unit (SKU)', 'sku'),

            Text::make('Discount', function () {
                if (is_null($this->promo())) {
                    return "---";
                }
                $rate = $this->promo()->discount_rate . "%";
                return "<span class='p-1 rounded'>$rate</span>";
            })->asHtml(),

            Textarea::make('Notes')
                ->alwaysShow(),

            Text::make('Quantity')
                ->sortable()
                ->exceptOnForms(),

            Currency::make('TotalCost')
                ->sortable()
                ->exceptOnForms(),

            HasMany::make("Inventories", 'inventories', Inventory::class),
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
            (new NewAdjustment),
        ];
    }
}
