<?php

namespace App\Nova;

use App\Nova\Actions\AddToCart;
use App\Nova\Filters\ProductFilter;
use App\Rules\NoDuplicateProduct;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Inventory extends  BranchResourceFilter
{

    public static $group = '2. Catalog';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Inventory::class;

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
        'product_name',
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
            BelongsTo::make('Branch', 'branch', Branch::class),
            BelongsTo::make('Size', 'product', Product::class),
            Currency::make('Sales Price', fn () => $this->product ? $this->product->price : 0),
            Currency::make('Cost', fn () => $this->product ? $this->product->cost: 0),
            Number::make('Quantity On Hand', 'qty')->sortable(),
            Number::make('Reorder Point'),
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
            ProductFilter::make(),
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
        $price = 0;
        $qty = 0;
        if ($this->id) {
            $p = \App\Models\Product::find($this->product_id);
            $price = $p->price;
            $qty = $this->qty;
        }
        return [
            AddToCart::make(\App\Models\Product::class, $price, $qty)
                ->showOnTableRow(),
        ];
    }
}
