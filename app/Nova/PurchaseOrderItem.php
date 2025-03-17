<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
class PurchaseOrderItem extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PurchaseOrderItem::class;

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
            BelongsTo::make('PO', 'purchaseOrder', PurchaseOrder::class),
            BelongsTo::make('Product', 'product', Product::class)->exceptOnForms(),
            Select::make('Product', 'product_id')
                ->options(function () {
                    $options = [];
                    $ps = \App\Models\Product::with(['brand'])->get();
                    foreach ($ps as $e) {
                        $brand = $e->brand ? $e->brand->name: 'N/a';
                        $product = $e->name;
                        $options[$e->id] = "$brand - $product";
                    }
                    return $options;
                })
                ->onlyOnForms()
                ->searchable(),
            Number::make('Quantity', 'qty')
                ->sortable(),
            Currency::make('Cost')
                ->default(0),
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
        return [];
    }
}
