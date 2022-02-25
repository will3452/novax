<?php

namespace App\Nova;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class TestItem extends Resource
{

    public static $group = 'Data';

    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TestItem::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function isAuthorized(): bool
    {
        if (auth()->user()->hasRole(User::ROLE_DOCTOR)) {
            return true;
        }

        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            return true;
        }

        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->hasRole(User::ROLE_DOCTOR)) {
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
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'created_at',
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
            BelongsTo::make('Record')
                ->rules(['required']),
            Text::make('Test Name', 'name')
                ->rules(['required']),
            DateTime::make('Date')
                ->rules(['required']),
            Textarea::make('Result')
                ->alwaysShow()
                ->rules(['max:500']),
            Text::make('Conducted By'),
            Textarea::make('Diagnosis Summary')
                ->alwaysShow()
                ->rules(['max:500']),
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