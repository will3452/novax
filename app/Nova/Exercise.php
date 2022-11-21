<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Exercise extends Resource
{
    public static $group = 'Management';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Exercise::class;

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
        'name',
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
            Text::make('Name')
                ->rules(['required']),
            Select::make('Scale')
                ->options([
                    'Below normal weight' => 'Below normal weight',
                    'Normal Weight' => 'Normal Weight',
                    'Overweight' => 'Overweight',
                    'Class I Obesity' => 'Class I Obesity',
                    'Class II Obesity' => 'Class II Obesity',
                    'Class III Obesity' => 'Class III Obesity'
                ]),
            BelongsTo::make('Program', 'program', Program::class),
            Select::make('Type')
                ->rules(['required'])
                ->options([
                    'Flexibility' => 'Flexibility',
                    'Aerobic' => 'Aerobic',
                    'Strength' => 'Strength',
                ]),
            Image::make('Image')
                ->rules(['required', 'image', 'max:2000']),
            Textarea::make('Instructions', 'instruction')
                ->alwaysShow()
                ->rules(['required']),
            Textarea::make('Benefits')
                ->alwaysShow()
                ->rules(['required']),
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
