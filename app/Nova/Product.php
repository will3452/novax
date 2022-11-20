<?php

namespace App\Nova;

use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Symfony\Component\Intl\Currencies;

class Product extends Resource
{
    public static $group = 'Library';
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
            Select::make('Category')
                ->options([
                    ModelsProduct::CATEGORY_FOOD => ModelsProduct::CATEGORY_FOOD,
                    ModelsProduct::CATEGORY_NONFOOD => ModelsProduct::CATEGORY_NONFOOD,
                ]),
            Text::make('Product ID', 'product_id')
                ->rules(['required', 'unique:products,product_id,{{resourceId}}']),
            Textarea::make('Description')
                ->rules(['required', 'max:255'])
                ->alwaysShow(),
            Image::make('Image')
                ->rules(['image', 'max:2000', 'required']),
            Text::make('Unit of Measurement', 'uom')
                ->rules(['required']),
            Number::make('quantity')->rules(['required']),
            Currency::make('Unit cost')->rules(['required']),
            Currency::make('Product cost')->rules(['required']),
            Currency::make('Selling price')->rules(['required']),
            Hidden::make('user_id')->default(fn () => auth()->id()),
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
