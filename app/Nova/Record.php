<?php

namespace App\Nova;

use App\Models\Role;
use App\Nova\Actions\AddXrayImage;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Record extends Resource
{

    public static $group = 'Data';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Record::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference_number',
        'created_at',
    ];

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->hasRole(Role::SUPERADMIN);
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->hasRole(Role::SUPERADMIN);
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->hasRole(Role::SUPERADMIN);
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
            Date::make('Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            Text::make('Reference Number')
                ->exceptOnForms()
                ->sortable(),

            BelongsTo::make('Patient', 'user', User::class)
                ->rules(['required']),

            Textarea::make('Insurance Details')
                ->alwaysShow()
                ->help('maximum of 500 characters only.')
                ->rules(['max:500']),

            HasMany::make('Test Items', 'testItems', TestItem::class),

            MorphMany::make('X-ray Images', 'images', Image::class),
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
        return [
            (new AddXrayImage)
                ->canSee(function () {
                    if (auth()->user()->hasRole(Role::SUPERADMIN)) {
                        return true;
                    }

                    if (auth()->user()->hasRole(\App\Models\User::ROLE_DOCTOR)) {
                        return true;
                    }

                    return false;
                }),
        ];
    }
}
