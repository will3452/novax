<?php

namespace App\Nova;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AuditLog extends Resource
{

    public static function authorizedToCreate(Request $request)
    {
        return false; 
    }

    public function authorizedToView(Request $request)
    {
        return false; 
    }

    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, [User::TYPE_ADMINISTRATOR, User::TYPE_SUPERVISOR]);  
    }

    
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AuditLog::class;

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
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('User', 'user', User::class)->hideWhenCreating()->hideWhenUpdating(), 
            Text::make('Activity', 'activity')->onlyOnIndex(), 
            Date::make('Date', 'created_at')
                ->onlyOnIndex()
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
