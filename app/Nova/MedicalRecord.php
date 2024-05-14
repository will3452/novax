<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class MedicalRecord extends Resource
{
    public static function group () {
        return 'MANAGE'; 
    }
    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            return false;
        }

        return true; 
    }

    public function authorizedToDelete(Request $request)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            return false;
        }

        return true;
    }

    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            return false;
        }

        return true;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            return $query->whereUserId(auth()->id());
        }

        return $query;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\MedicalRecord::class;

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
            BelongsTo::make('Patient', 'user', User::class)
                ->showCreateRelationButton()
                ->searchable(), 
            Text::make('Physician'), 
            Select::make('Initial Visit Pain Score', 'initial_pain_score')
                ->options([
                    1 => 1, 
                    2 => 2, 
                    3 => 3, 
                    4 => 4, 
                    5 => 5, 
                    6 => 6, 
                    7 => 7, 
                    8 => 8, 
                    9 => 9, 
                    10 => 10, 
                ]),
            Textarea::make('Initial Visit Remarks', 'initial_remarks')
                ->alwaysShow(), 
            Select::make('Follow Up Pain Score', 'follow_up_pain_score')
                ->options([
                    1 => 1, 
                    2 => 2, 
                    3 => 3, 
                    4 => 4, 
                    5 => 5, 
                    6 => 6, 
                    7 => 7, 
                    8 => 8, 
                    9 => 9, 
                    10 => 10, 
                ]),
            Textarea::make('Follow up Remarks', 'follow_up_remarks')
                ->alwaysShow(), 
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
