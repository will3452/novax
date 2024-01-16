<?php

namespace App\Nova;

use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Silvanite\NovaFieldCheckboxes\Checkboxes;

class Destination extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Destination::class;

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
        'name'
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
            Text::make('Name')
                ->rules(['required']),
            Text::make('Location')
                ->rules(['required']), 
            MapMarker::make('Coordinates')
                ->latitude('lat')
                ->longitude('lng'), 
            Trix::make('Description'), 
            BelongsTo::make('Category', 'category', Category::class), 
            Currency::make('Entry Fees'), 
            Text::make('Operating Hours'), 
            Text::make('Best Time To Visit'), 
            Checkboxes::make('Nearby Accommodations')
                ->options([
                    'Hotel' => 'Hotel',
                    'Motel' => 'Motel',
                    'Resort' => 'Resort',
                    'Hostel' => 'Hostel',
                    'Bed & Breakfast' => 'Bed & Breakfast',
                    'Vacation rental' => 'Vacation rental', 
                    'Inn' => 'Inn', 
                ])->withoutTypeCasting(), 
            Checkboxes::make('Transportation')
                ->options([
                    'Car' => 'Car',
                    'Bus' => 'Bus',
                    'Train' => 'Train',
                    'Plane' => 'Plane',
                    'Ship' => 'Ship',
                    'Bicycle' => 'Bicycle',
                    'Walking' => 'Walking', 
                ])->withoutTypeCasting(),
            Checkboxes::make('Weather')
                ->options([
                    'Clear Sky' => 'Clear Sky',
                    'Partly Cloudy' => 'Partly Cloudy',
                    'Cloudy' => 'Cloudy',
                    'Overcast' => 'Overcast',
                    'Rainy' => 'Rainy',
                    'Thunderstorm' => 'Thunderstorm',
                    'Snowy' => 'Snowy',
                    'Foggy' => 'Foggy'
                ])->withoutTypeCasting(), 

            HasMany::make('Photographs', 'photographs', Photograph::class), 
            
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
