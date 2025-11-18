<?php

namespace App\Nova;

use App\Nova\Actions\AddToCart;
use App\Nova\Actions\RemoveToCart;
use App\Nova\Actions\RunInventoryForecast;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Sparkline;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->role === \App\Models\User::ROLE_ADMIN) return true;
        return false;
    }
    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->role === \App\Models\User::ROLE_ADMIN) return true;
        if ($request->has('action')) return true;
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
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

    public function title() {
        return "$this->name (Category: $this->category, Price: $this->price)";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'category',
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
            Select::make('Category')
                ->options([
                    \App\Models\Product::CATEGORY_SINGLE => 'Single',
                    \App\Models\Product::CATEGORY_BUNDLE => 'Bundle',
                ])
                ->rules('required')
                ->sortable(),
            Image::make('Image'),
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
            Currency::make('Price')
                ->sortable()
                ->rules('required', 'min:0'),
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
        if ($request->has('action')) {
            return [
                AddToCart::make(),
                RemoveToCart::make(),
            ];
        }
        $EMPTY_STOCK = 0;

        $INSIDE_CART = $this->orderItems()->whereHas('order', function ($query) {
            $query->where('employee_id', auth()->id())
                  ->whereIn('status', [\App\Models\Order::STATUS_PENDING]);
        })->exists();


        if ($this->current_stock == $EMPTY_STOCK) {
            return [
            ];
        }

        if ($INSIDE_CART) {
            return [
                RemoveToCart::make(),
            ];
        }

        return [
            AddToCart::make(),
        ];
    }
}
