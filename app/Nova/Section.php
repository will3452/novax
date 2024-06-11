<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use App\Models\SectionStudent;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Actions\InviteStudent;
use Laravel\Nova\Fields\BelongsToMany;
use App\Models\Section as ModelsSection;
use Laravel\Nova\Http\Requests\NovaRequest;
use KirschbaumDevelopment\NovaComments\Commenter;

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
            Tabs::make('Section', [
                Tab::make('Section Information', [
                    BelongsTo::make('Course', 'course', Course::class), 
                    Text::make('Section'),
                    Select::make('School Year')
                        ->default(function () {
                            return nova_get_setting('school_year'); 
                        })
                        ->options(\App\Models\SchoolYear::get()->pluck('name', 'name')),
                    Select::make('Term')
                        ->default(function () {
                            return nova_get_setting('term'); 
                        })
                        ->options(\App\Models\Term::get()->pluck('name', 'name')), 
                    // Number::make('No of Students')->rules(['min:1']), 
                    Hidden::make('no_of_students')->default(fn () => 100), 
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
                            \App\Models\Title::IC_TYPE_PLANT_DESIGN => \App\Models\Title::IC_TYPE_PLANT_DESIGN,
                            \App\Models\Title::IC_TYPE_FEASIBILITY_STUDY => \App\Models\Title::IC_TYPE_FEASIBILITY_STUDY,
                            \App\Models\Title::IC_TYPE_BUSINESS_PLAN => \App\Models\Title::IC_TYPE_BUSINESS_PLAN,
                        ]),
                    Hidden::make('creator_id')
                        ->default(fn() => auth()->id()),
                    
                    BelongsTo::make('Creator', 'creator', User::class)->onlyOnDetail(), 
                    Text::make('Pass Code')->onlyOnForms(), 
                    ]),
                    Tab::make('Students', [
                        HasMany::make('Students', 'students', ClassInvitation::class)->canSee(fn () => auth()->user()->isCoordinator()),
                    ]), 
                    Tab::make('Titles', [
                        HasMany::make('Titles', 'titles', Title::class), 
                    ])
            ])->withToolbar(),  
            new Commenter(),
            MorphMany::make(
                'Comments',
                'comments',
                \KirschbaumDevelopment\NovaComments\Nova\Comment::class
            )->onlyOnForms(),
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
        $resourceId = $request->resourceId ?? request()->resourceId;
        if (! $resourceId) {
            $urlArray = explode("/", parse_url(request()->headers->get('referer'))['path']); 
            $resourceId = end($urlArray); 
        }
        if (! is_numeric($resourceId)) return []; 
        return [
            (new InviteStudent(intval($resourceId)))->canSee(fn () => auth()->user()->isCoordinator()), 
        ];
    }
}
