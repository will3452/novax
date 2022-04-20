<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Exam extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public static function isAdmin() {
        return auth()->user()->hasRole(\App\Models\Role::SUPERADMIN);
    }

    public function authorizedToDelete(Request $request)
    {
        return self::isAdmin();
    }

    public function authorizedToView(Request $request)
    {
        return self::isAdmin();
    }

    public function authorizedToUpdate(Request $request)
    {
        return self::isAdmin();
    }

    public static function availableForNavigation(Request $request)
    {
        return self::isAdmin();
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('email', '!=', 'super@admin.com');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Exam::class;

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
        'code',
        'created_at',
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
            Date::make('Date Created', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make('Teacher', 'teacher', User::class),
            Text::make('Name')
                ->rules(['required']),
            Select::make('Strand')
                ->options(collect(\App\Models\User::STRAND)->flatMap(fn ($e) => [$e => $e])->all()),
            Select::make('Level')
                ->options(collect(\App\Models\User::LEVEL)->flatMap(fn ($e) => [$e => $e])->all()),
            Text::make('Time Limit', 'time_limit')
                ->help('In minutes'),
            Date::make('Opened At')
                ->rules(['required']),
            Date::make('Closed At')
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
