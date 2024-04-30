<?php

namespace App\Nova;

use App\Nova\Actions\Approve;
use App\Nova\Actions\MarkAsPresentToday;
use App\Nova\Actions\MarkAsVisited;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Http\Requests\NovaRequest;

class Trainee extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {

        if (in_array(auth()->user()->type, [\App\Models\User::TYPE_COORDINATOR, \App\Models\User::TYPE_HTE])) {
            $results = \App\Models\Supervision::whereHeadId(auth()->id())->pluck('member_id')->toArray(); 
            return $query->whereIn('id', $results); 
        }
        return $query; 
    }
    public static function availableForNavigation(Request $request)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            return false; 
        }
        return true; 
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN; 
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Trainee::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "$this->name [$this->type]"; 
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'email', 
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
            Hidden::make('type')->default(fn () => \App\Models\User::TYPE_TRAINEE), 
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Text::make('School'),
            
            Date::make('Approved Date', 'approved_at'), 
            HasMany::make('Applications', 'applications', Application::class), 
            Text::make('HTE Location', function () {
                $userId = \App\Models\Supervision::whereMemberId($this->id)->latest()->first(); 
                if (! $userId) return '---';

                $hte = \App\Models\User::whereId($userId->head_id)->first();
                $lat = $hte->lat; 
                $lng = $hte->lng; 
                return "<a href='/map?lat=$lat&lng=$lng'>
                <img style='margin: 0.5em;cursor:pointer;' src='https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/$lng,$lat,10,20/100X70?access_token=pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw'/>
                </a>"; 
            })->asHtml(), 
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
        if (\App\Models\User::TYPE_ADMIN == auth()->user()->type) {
            array_push($actions, Approve::make()); 
        }

        if (\App\Models\User::TYPE_HTE == auth()->user()->type) {
            array_push($actions, MarkAsPresentToday::make());
        }

        if (\App\Models\User::TYPE_COORDINATOR == auth()->user()->type) {
            array_push($actions, MarkAsVisited::make());
        }
        return $actions; 
        // return [
        //     MarkAsPresentToday::make(), 
        //     Approve::make(), 
        // ];
    }
}
