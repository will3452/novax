<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

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
        'user_id',
        'total',
        'status'
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
            Badge::make('Status')
                ->map([
                    'Completed' => 'success',
                    'Delivery' => 'info',
                    'Packaging' => 'warning',
                ]),
            Text::make('Items', function() {
                $items = "<ul>";
                $data = $this->products;
                foreach ($data as $d) {
                    $product = $d->product_name;
                    $qty = $d->order_quantity;
                    $price = $d->product_price;
                    $items .= "<li>$qty x - $product (php $price)</li>";
                }
                return $items .= "</ul>";
            })->asHtml(),
            Text::make('SubTotal', 'subTotal'),
            Text::make('VAT due', 'vatDue'),
            Text::make('Total'),
            BelongsTo::make('User', 'user', User::class),
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
            new ChangeStatus
        ];
    }
}
