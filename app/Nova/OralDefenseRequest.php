<?php

namespace App\Nova;

use App\Models\OralDefenseRequest as ModelsOralDefenseRequest;
use App\Nova\Actions\SubmitToPanelist;
use App\Nova\Actions\ViewOralDefenseRequestForm;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OralDefenseRequest extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return false; 
    }
    public static function authorizedToCreate(Request $request)
    {
        return false; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return false; 
    }

    public function authorizedToDelete(Request $request)
    {
        return false; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\OralDefenseRequest::class;

    public static $searchable = false; 

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
            // BelongsTo::make('Section', 'section', Section::class), 
            BelongsTo::make('Group', 'group', Group::class), 
            Date::make('Date', 'date',),
            Text::make('Time', 'time'), 
            Text::make('Venue'), 
            Badge::make('Status')
                ->map([
                    ModelsOralDefenseRequest::SUBMIT_ORAL_DEFENSE => 'warning',
                    ModelsOralDefenseRequest::PANELIST_APPROVAL => 'info',
                    ModelsOralDefenseRequest::COORDINATOR_APPROVAL => 'warning',
                    'APPROVED' => 'success',
                    ModelsOralDefenseRequest::REJECTED => 'danger',
                ])
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
        if ($request->action == 'submit-to-panelist') {
            return [
                SubmitToPanelist::make(), 
            ];
        }
        return [
            ViewOralDefenseRequestForm::make(), 
            SubmitToPanelist::make()->canSee(fn () => auth()->user()->isStudent() && ($this->status == "Submit Oral Defense Request")), 
        ];
    }
}
