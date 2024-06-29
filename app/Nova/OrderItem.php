<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class OrderItem extends Resource
{
    public static $group = 'Store';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\OrderItem::class;

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
            BelongsTo::make('Order', 'order', Order::class),             
            BelongsTo::make('Product', 'product', Product::class), 
            Number::make('Quantity'),
            Number::make('Unit Price'),
            Number::make('Total Amount'), 
            Heading::make('Payment details'), 
            Text::make('Payment Method'),
            Text::make('Payment Status'),
            Heading::make('Shipping Information'), 
            Text::make('Shipping Address'),
            Text::make('Shipping City'),
            Text::make('Shipping Province'),
            Text::make('Shipping Postal Code'),
            Country::make('Shipping Country'),
            Text::make('Shipping Method'), 
            Number::make('Shipping Cost'), 
            Text::make('Shipping Tracking Number'),
            Text::make('Shipping Status'),
            Heading::make('Discount details'), 
            Text::make('Discount Code'),
            Text::make('Discount Amount'), 
            Heading::make('Tax Details'),
            Text::make('Tax Rate'),
            Text::make('Tax Amount'), 

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
