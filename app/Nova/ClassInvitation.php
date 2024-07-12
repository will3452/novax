<?php

namespace App\Nova;

use App\Nova\Actions\ImportStudents;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Badge;
use App\Nova\Actions\JoinClass;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClassInvitation extends Resource
{
    public static $group = 'Task & Activities';
    
    public static function availableForNavigation(Request $request)
    {
        return false; 
    }
    
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->isCoordinator()) return $query; 
        if (auth()->user()->isStudent()) return $query->whereStatus('PENDING')->whereStudentId(auth()->id());
        return $query->whereStatus('PENDING');
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
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SectionStudent::class;

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
            
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(), 
            Text::make('Course', function () {
                if (! $this->course) return "---"; 
                return $this->course->name; 
            }), 
            BelongsTo::make('Student', 'student', User::class),
            BelongsTo::make('Section', 'section', Section::class), 
            Badge::make('Status', 'status')
                ->map([
                    'JOINED' => 'success',
                    'PENDING' => 'warning', 
                ]), 
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
            JoinClass::make()
                ->canSee(fn () => auth()->user()->isStudent()), 
        ];
    }
}
