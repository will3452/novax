<?php

namespace App\Nova;

use App\Nova\Actions\JoinClass;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClassInvitation extends Resource
{
    public static $group = 'Task';
    
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->isStudent(); 
    }
    
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->isCoordinator()) return $query; 
        return $query->whereStatus('PENDING');
    }
    public static function authorizedToCreate(Request $request)
    {
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
            ID::make(__('ID'), 'id')->sortable(),
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
