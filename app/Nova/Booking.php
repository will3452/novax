<?php

namespace App\Nova;

use App\Nova\Actions\MarkAsApproved;
use App\Nova\Actions\RequestAppointment;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
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
        if ($request->has('action')) {
            return true; 
        }
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            return false;
        }

        return true;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            return $query->wherePatientId(auth()->id());
        }

        return $query;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Booking::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'reference', 
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
            Date::make('Date Requested', 'created_at')->sortable(),
            Text::make('Reference'),
            BelongsTo::make('Patient', 'patient', User::class), 
            BelongsTo::make('Service', 'service', Service::class), 
            Badge::make('Status')
                ->map([
                    'For Approval' => 'info',
                    'Approved' => 'success', 
                ]), 
            Textarea::make('Remarks')->alwaysShow(), 
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
        $actions = [];
        if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            array_push($actions, RequestAppointment::make()->standalone()); 
            return $actions; 
        }

        
        return [
            MarkAsApproved::make(), 
        ];
    }
}
