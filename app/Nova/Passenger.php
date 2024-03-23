<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use App\Nova\Actions\Approve;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Http\Requests\NovaRequest;

class Passenger extends Resource
{
    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR;
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR;
    }

    public function authorizedToView(Request $request)
    {
        return true; 
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Passenger::class;

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
            Badge::make('Status', fn () => $this->approved_at == null ? "FOR APPROVAL": "APPROVED")->map([
                'APPROVED' => 'success',
                'FOR APPROVAL' => 'warning',
            ]), 
            Hidden::make('type')->default(\App\Models\User::TYPE_PASSENGER), 
            // Avatar::make('Image'),
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
    {   $actions = [];
        if (auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR) {
            array_push($actions, Approve::make()); 
        }
        return $actions;
    }
}
