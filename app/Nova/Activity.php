<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Trix;
use App\Models\User as UserModel;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class Activity extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR;
    }
    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    public  function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    public  function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Activity::class;

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
        'date',
        'description',
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
            BelongsTo::make('Document', 'document', Document::class),
            Trix::make('Description')
                ->alwaysShow()
                ->rules(['required']),
            DateTime::make('Date')
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
