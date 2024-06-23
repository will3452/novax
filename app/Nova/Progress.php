<?php

namespace App\Nova;

use App\Models\Panellist;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Nova\Actions\ViewForm;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ViewProgressForm;
use App\Models\Progress as ModelsProgress;
use Laravel\Nova\Http\Requests\NovaRequest;

class Progress extends Resource
{
    public static $searchable = false; 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Progress::class;

    public static function availableForNavigation(Request $request)
    {
        return false; 
    }

    
    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->isStudent(); 
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->isStudent(); 
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true; 
        }
        return auth()->user()->isStudent(); 
    }

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
            BelongsTo::make('Group', 'group', Group::class), 
            BelongsTo::make('Section', 'section', Section::class), 
            Number::make('Week')->rules(['required', 'min:1']),
            Date::make('From', 'from_date')
                ->rules(['required']),
            Date::make('To', 'to_date')
                ->rules(['required']), 
            Textarea::make('Description')
                ->alwaysShow()
                ->rules(['required']),
            Boolean::make('Ready for oral Defense', 'is_ready_for_oral_def')->exceptOnForms(), 
            Badge::make('Status')
                ->map([
                    'For Adviser Approval' => 'warning',
                    'For Coordinator Approval' => 'info',
                    'Approved' => 'success', 
                ]),
            Text::make('Preferred Schedule')->exceptOnForms(), 
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
            ViewProgressForm::make()->canSee(function () {
                $p = Panellist::whereGroupId($this->group_id)->whereType('Adviser')->first(); 
                if ($this->status == ModelsProgress::FOR_ADVISER_APPROVAL && $p->faculty_id == auth()->id() || $this->status == ModelsProgress::FOR_COORDINATOR) return true; 
                if ($this->status == ModelsProgress::FOR_COORDINATOR && auth()->id() == nova_get_setting('coordinator_id')) return true; 
                return $this->status == ModelsProgress::APPROVED; 
            }), 
        ];
    }
}
