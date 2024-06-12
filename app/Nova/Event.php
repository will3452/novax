<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Event extends Resource
{
    public static function group()
    {
        if (auth()->user()->isStudent()) return "Social"; 
        return "Manage"; 
    }

    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->isStudent()) return false; 
        if (auth()->id() == nova_get_setting('coordinator_id')) return true; 
        return false; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->isStudent()) return false; 
        if (auth()->id() == nova_get_setting('coordinator_id')) return true; 
        return false; 
    }

    public function authorizedToDelete(Request $request)
    {
        if (auth()->user()->isStudent()) return false; 
        if (auth()->id() == nova_get_setting('coordinator_id')) return true; 
        return false; 
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Event::class;

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
        'title',
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
            DateTime::make('Date', 'start')->sortable(), 
            Text::make('Title'), 
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
