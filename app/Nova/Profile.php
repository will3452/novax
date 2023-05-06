<?php

namespace App\Nova;

use App\Models\User as ModelUser;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Profile extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == ModelUser::TYPE_ADMIN;
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == ModelUser::TYPE_ADMIN;
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == ModelUser::TYPE_ADMIN;
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == ModelUser::TYPE_ADMIN;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Profile::class;

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
            Text::make('Student/Instructor Number', 'number')
                ->rules(['required']),
            Select::make('Curriculum', 'curriculum_id')
                ->displayUsingLabels()
                ->options(function () {
                    return \App\Models\Curriculum::get()->pluck('name', 'id');
                }),
            Select::make('Course')
                ->displayUsingLabels()
                ->options(function () {
                    return \App\Models\Course::get()->pluck('name', 'name');
                }),
            Text::make('Address'),
            Text::make('Mobile'),
            BelongsTo::make('User', 'user', User::class)
                ->hideFromDetail(auth()->user()->type != ModelUser::TYPE_ADMIN)
                ->hideFromIndex(auth()->user()->type != ModelUser::TYPE_ADMIN)
                ->showCreateRelationButton(),
            BelongsTo::make('Curriculum', 'curriculum', Curriculum::class),
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
