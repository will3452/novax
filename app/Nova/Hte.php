<?php

namespace App\Nova;

use App\Nova\Actions\Approve;
use App\Nova\Actions\ViewInMap;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Http\Requests\NovaRequest;

class Hte extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_COORDINATOR, ])) {
            return $query->where('approved_at', '!=', null); 
        }
        return $query;
    }
    public static function availableForNavigation(Request $request)
    {
        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_TRAINEE, \App\Models\User::TYPE_HTE])) {
            return false; 
        }
        return true; 
    }

    public static function authorizedToCreate(Request $request)
    {
        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_COORDINATOR, ])) {
            return false; 
        }
        return true; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_COORDINATOR, ])) {
            return false; 
        }
        return true; 
    }

    public function authorizedToDelete(Request $request)
    {
        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_COORDINATOR, ])) {
            return false; 
        }
        return true; 
    }

    public static function label () {
        return "HTE"; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Hte::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "$this->name [$this->type]"; 
    }

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
            Hidden::make('type')->default(fn () => \App\Models\User::TYPE_HTE), 
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Date::make('Approved Date', 'approved_at'), 
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
        $actions = [];
        if (\App\Models\User::TYPE_ADMIN == auth()->user()->type) {
            array_push($actions, Approve::make()); 
            array_push($actions, ViewInMap::make()); 

        }
        return $actions;
    }
}
