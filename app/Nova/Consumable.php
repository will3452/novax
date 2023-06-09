<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Consumable extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Consumable::class;

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

            Text::make('Name'),

            BelongsTo::make('Category', 'category', 'App\Nova\Category'),

            BelongsTo::make('Manufacturer', 'manufacturer', 'App\Nova\Manufacturer'),

            BelongsTo::make('Department', 'department', 'App\Nova\Department'),

            BelongsTo::make('Supplier', 'supplier', 'App\Nova\Supplier'),

            BelongsTo::make('User', 'user', 'App\Nova\User'),

            Text::make('Image'),

            Number::make('Bound'),

            Text::make('Status'),

            Number::make('Quantity'),

            Number::make('Remaining'),

            DateTime::make('Purchase At'),

            Number::make('Purchase Cost'),

            BelongsTo::make('Asset', 'asset', 'App\Nova\Asset'),
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
