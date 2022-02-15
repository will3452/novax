<?php

namespace App\Nova;

use App\Models\Role;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Models\Schedule as ModelsSchedule;
use Laravel\Nova\Http\Requests\NovaRequest;

class Schedule extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Schedule::class;

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
        'day',
        'time',
    ];

    public function isAuthorized(): bool
    {
        if (auth()->user()->hasRole(\App\Models\User::ROLE_DOCTOR)) {
            return true;
        }

        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            return true;
        }

        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->hasRole(\App\Models\User::ROLE_DOCTOR)) {
            return true;
        }

        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            return true;
        }

        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $this->isAuthorized();
    }

    public function authorizedToDelete(Request $request)
    {
        return $this->isAuthorized();
    }

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
            BelongsTo::make('Doctor', 'user', User::class)
                ->exceptOnForms(),
            Select::make('Day')
                ->rules(['required'])
                ->options(ModelsSchedule::DAYS),
            Text::make('Time')
                ->help('format: HH:MM - HH:MM (eg. 7:00 AM - 8:00 AM)')
                ->rules(['required'])
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
