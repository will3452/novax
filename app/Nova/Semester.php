<?php

namespace App\Nova;

use App\Models\User as ModelUser;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class Semester extends Resource
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
    public static $model = \App\Models\Semester::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'semester';

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
            Text::make('Semester')
                ->rules(['required'])
                ->sortable(),
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
