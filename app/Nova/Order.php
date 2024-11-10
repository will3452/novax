<?php

namespace App\Nova;

use App\Nova\Actions\MarkAsApproved;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    public static $group = 'Sales';
    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;

        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, ['administrator', 'sales',]);
    }
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
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Customer', 'customer', Customer::class),
            BelongsTo::make('Product', 'product', Product::class),
            Hidden::make('sales_associate_id')->default(fn () => auth()->id()),
            BelongsTo::make('Sales Associate', 'salesAssociate', User::class)->exceptOnForms(),
            Badge::make('Status')
                ->map([
                    'Pending' => 'danger',
                    'Confirmed' => 'success',
                ]),
            Number::make('Quantity')
                ->rules(['required', 'min:1']),
            Currency::make('Amount'),
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
            MarkAsApproved::make(),
        ];
    }
}
