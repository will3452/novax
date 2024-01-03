<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;

class Bus extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Bus::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'number',
        'plate_number',
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
            Select::make('type')
                ->hideWhenUpdating()
                ->options([
                    'FIRST CLASS' => 'FIRST CLASS',
                    'REGULAR AIRCON' => 'REGULAR AIRCON',
                ])->sortable(),
            Hidden::make('Status')
                ->hideWhenUpdating()
                ->default(fn () => 'AVAILABLE'), 
            Select::make('Status')
                ->hideWhenCreating()
                ->sortable()
                ->default(fn() => 'AVAILABLE')
                ->options([
                    'AVAILABLE' => 'Not Assigned',
                    'NOT AVAILABLE' => 'Assigned',
                ])->displayUsingLabels(),
            Text::make('Plate Number')
                ->hideWhenUpdating()
                ->rules(['required']),
            Text::make('Bus Number', 'number')
                ->hideWhenUpdating()
                ->rules(['required']),
            Number::make('Capacity')
                ->hideWhenUpdating()
                ->rules(['required']),
            Currency::make('Additional Fee')
                ->default(fn () => 0), 
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
