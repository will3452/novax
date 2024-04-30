<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class Attendance extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            return $query->whereTraineeId(auth()->id());
        }

        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_COORDINATOR, \App\Models\User::TYPE_HTE])) {
            $results = \App\Models\Supervision::whereHeadId(auth()->id())->pluck('member_id')->toArray(); 
            return $query->whereIn('trainee_id', $results); 
        }
        return $query; 
    }
    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN;  
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->type == \App\Models\User::TYPE_HTE;  
    }
    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->type == \App\Models\User::TYPE_HTE;  
    }

    public function authorizedToView(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->type == \App\Models\User::TYPE_HTE;  
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Attendance::class;

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
            DateTime::make('Date & Time', 'created_at'), 
            BelongsTo::make('Trainee', 'trainee', Trainee::class),
            BelongsTo::make('HTE', 'hte', Hte::class,)
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
