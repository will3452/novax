<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;

class Component extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Component::class;

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
            ID::make()->sortable(),

            Image::make('Image'),

            Text::make('Name'),

            BelongsTo::make('Category', 'category', 'App\Nova\Category'),

            Text::make('Serial'),

            BelongsTo::make('Manufacturer', 'manufacturer', 'App\Nova\Manufacturer'),

            BelongsTo::make('Supplier', 'supplier', 'App\Nova\Supplier'),

            BelongsTo::make('Asset', 'asset', 'App\Nova\Asset'),

            BelongsTo::make('User', 'user', 'App\Nova\User'),

            BelongsTo::make('AssetModel', 'assetModel', 'App\Nova\AssetModel'),

            BelongsTo::make('Condition', 'condition', 'App\Nova\Condition'),

            DateTime::make('Purchase Date', 'purchase_at'),

            Number::make('Purchase Cost'),
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
