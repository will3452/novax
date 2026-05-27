<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;


class OrderItem extends Resource
{
    public static function availableForNavigation(Request $request)
{
    return false;
}

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        if ($request->has('viaResourceId')) {
            return \App\Models\Order::find($request->viaResourceId)->status === \App\Models\Order::STATUS_PENDING;
        }
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('viaResourceId')) {
            return \App\Models\Order::find($request->viaResourceId)->status === \App\Models\Order::STATUS_PENDING;
        }
        return false;
    }

    public static $searchable = false;
    



    public function authorizedToView(Request $request)
    {
        return false;
    }
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
        Text::make('Product', function () {
    return $this->product->name ?? 'Deleted Product';
})->sortable(),

        Number::make('Quantity', 'qty')
            ->sortable()
            ->rules(['required', 'min:1']),

        // ADD THIS: Display the price to prevent 'property on null' UI errors
        Number::make('Price', 'price')
            ->displayUsing(function ($value) {
                return '₱' . number_format($value, 2);
            })
            ->exceptOnForms(),
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

    public function product()
{
    return $this->belongsTo(Product::class)->withDefault([
        'name' => 'Deleted Product',
        'price' => 0,
    ]);
}
}
