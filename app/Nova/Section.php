<?php

namespace App\Nova;

use App\Models\Section as ModelsSection;
use App\Models\SectionStudent;
use App\Nova\Actions\InviteStudent;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Section extends Resource
{
    public static function group()
    {
        if (auth()->user()->isStudent()) return "Class"; 
        return "Manage"; 
    }

    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->isCoordinator()) return true; 
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        if (auth()->user()->isCoordinator()) return true; 
        return false; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->isCoordinator()) return true; 
        return false; 
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->isStudent()) {
            $sections = SectionStudent::whereStudentId(auth()->id())->whereStatus('JOINED')->get()->pluck('section_id'); 
            return $query->whereIn('id', $sections); 
        }
        return $query;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Section::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'section';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'section', 
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
            BelongsTo::make('Course', 'course', Course::class), 
            Text::make('Section'),
            Select::make('School Year')
                ->options(\App\Models\SchoolYear::get()->pluck('name', 'name')),
            Select::make('Term')
                ->options(\App\Models\Term::get()->pluck('name', 'name')), 
            Number::make('No of Students')->rules(['min:1']), 
            Select::make('Thesis Phase')
                ->options([
                    ModelsSection::PHASE_PROPOSAL =>  ModelsSection::PHASE_PROPOSAL,
                    ModelsSection::PHASE_GATHERING =>  ModelsSection::PHASE_GATHERING,
                    ModelsSection::PHASE_FINAL =>  ModelsSection::PHASE_FINAL,
                ]),
            Select::make('IC type', 'ic_type')
                ->options([
                    \App\Models\Title::IC_TYPE_CAPSTONE => \App\Models\Title::IC_TYPE_CAPSTONE,
                    \App\Models\Title::IC_TYPE_THESIS => \App\Models\Title::IC_TYPE_THESIS,
                ]),
            Hidden::make('creator_id')
                ->default(fn() => auth()->id()),
            
            BelongsTo::make('Creator', 'creator', User::class)->onlyOnDetail(), 
            Password::make('Pass Code'), 
            HasMany::make('Students', 'students', ClassInvitation::class)->canSee(fn () => auth()->user()->isCoordinator()), 
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
            InviteStudent::make()->canSee(fn () => auth()->user()->isCoordinator()), 
        ];
    }
}
