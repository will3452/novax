<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Plant extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Plant::class;

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
        return[
            ID::make()->sortable(),

            Select::make('Type')
                ->rules(['required'])
                ->options(['Decorated' => 'Decorated', 'Root' => 'Root', 'Vegetable' => 'Vegetable']),

            Text::make('Common Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Scientific Name')
                ->nullable()
                ->rules('max:255'),

            Text::make('Habitat')
                ->nullable()
                ->rules('max:255'),

            Text::make('Family')
                ->nullable()
                ->rules('max:255'),

            Textarea::make('Description')
                ->nullable()
                ->rules('max:500'),

            Textarea::make('Tips')
                ->nullable()
                ->rules('max:500'),

            Text::make('Temp')
                ->nullable()
                ->rules('max:255'),

            Select::make('Air')
                ->options([
                    'Dry',
                    'Humid',
                ])
                ->nullable(),

            Select::make('Light')
                ->options([
                    'Low',
                    'Medium',
                    'Bright',
                ])
                ->nullable(),

            Image::make('Image')
                ->disk('public')
                ->path('plants')
                ->nullable(),
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
