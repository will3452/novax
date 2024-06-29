<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Timothyasp\Color\Color;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Google\Service\ShoppingContent\Brand;
use Google\Service\AdExchangeBuyerII\Price;
use Google\Service\Compute\Resource\Images;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Product extends Resource
{
    public static $group = 'Store';
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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'description',
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
            Hidden::make('user_id')
                ->default(fn () => auth()->id()), 
            BelongsTo::make('Store', 'store', Store::class),
            BelongsTo::make('Brand', 'brand', ProductBrand::class),
            Text::make('Name')
                ->sortable(),
            Textarea::make('Description')
                ->alwaysShow(),
            Select::make('Category')
                ->options(\App\Models\ProductCategory::get()->pluck('name', 'name'))
                ->sortable(),
            Select::make('Product Type')
                ->options(\App\Models\ProductType::get()->pluck('name', 'name'))
                ->sortable(),
            Number::make('Price')
                ->sortable(),
            Number::make('Discount Price')
                ->sortable(),
            Image::make('Primary Image'),
            Date::make('Available Release Date'),
            Select::make('Available Status')
                ->options([
                    'IN_STOCK' => 'IN_STOCK',
                    'OUT_OF_STOCK' => 'OUT_OF_STOCK',
                    'PRE_ORDER' => 'PRE_ORDER',
                ]),
            Text::make('Label'),
            Flexible::make('Images')
                ->button('New Image')
                ->addLayout('Image', 'image', [
                    Image::make('Image'),
                ]),
            Heading::make('Variants'),
            Flexible::make('Colors')
                ->button('New Color')
                ->addLayout('Color', 'color', [
                    Text::make('Name'),
                    Text::make('Code'),
                ]),
            Flexible::make('Sizes')
                ->button('New Size')
                ->addLayout('Size', 'size', [
                    Text::make('Name'),
                ]),
            Flexible::make('Attributes')
                ->button('New Attribute')
                ->addLayout('Attribute', 'attribute', [
                    Text::make('Property')
                        ->rules(['required']),
                    Text::make('Value')->rules(['required']),
                ])
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
