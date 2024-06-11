<?php

namespace App\Nova;

use App\Models\Title as ModelsTitle;
use App\Nova\Actions\ApproveApplication;
use App\Nova\Actions\CreateGroupFromThisTitle;
use App\Nova\Actions\RemoveAllApplications;
use App\Nova\Actions\SendApplication;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Title extends Resource
{
    public static function group()
    {
        if (auth()->user()->isStudent()) return "Class"; 
        return "Manage"; 
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_FACULTY) {
            return $query->whereFacultyId(auth()->id()); 
        }

        if (auth()->user()->isStudent()) {
            $sections = auth()->user()->sections()->get()->map(function($section, int $index) {
                return $section->id; 
            })->toArray(); 
            return $query->whereIn('section_id', $sections);
        }
        return $query;
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->isFaculty(); 
    }

    public function authorizedToDelete(Request $request)
    {
        return false; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return auth()->user()->isFaculty(); 
    }

    public function authorizedToView(Request $request)
    {
        return auth()->user()->isFaculty(); 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Title::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'description', 
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
                ->exceptOnForms()
                ->sortable(), 
            BelongsTo::make('Section', 'section', Section::class), 
            Text::make('Title')
                ->sortable(), 
            Textarea::make('Description')
                ->showOnIndex()
                ->alwaysShow(),
            Hidden::make('faculty_id')->default(fn () => auth()->id() ), 
            BelongsTo::make('Faculty', 'faculty', User::class)->exceptOnForms(), 
            Text::make('Applications', function () {
                $limit = $this->no_of_students; 
                $applications = $this->titleApplications()->count(); 
                return "$applications / $limit"; 
            }), 
            Number::make('No Of Students')
                ->hideFromIndex()
                ->rules(['required', 'max:3']),
            Text::make('Area of Research'),
            Select::make('IC type', 'ic_type')
                ->options([
                    ModelsTitle::IC_TYPE_CAPSTONE => ModelsTitle::IC_TYPE_CAPSTONE,
                    ModelsTitle::IC_TYPE_THESIS => ModelsTitle::IC_TYPE_THESIS,
                    ModelsTitle::IC_TYPE_FEASIBILITY_STUDY =>  ModelsTitle::IC_TYPE_FEASIBILITY_STUDY,
                    ModelsTitle::IC_TYPE_BUSINESS_PLAN => ModelsTitle::IC_TYPE_BUSINESS_PLAN,
                    ModelsTitle::IC_TYPE_PLANT_DESIGN => ModelsTitle::IC_TYPE_PLANT_DESIGN, 
                ]),
            Badge::make('Assigned Group', function () {
                return $this->status == 'Taken' ? 'Yes': 'No'; 
            })
                ->map([
                    'Yes' => 'warning',
                    'No' => 'success', 
                ]), 
            Hidden::make('Assigned Group', "status")
                ->default(fn () => 'Available'), 
            HasOne::make('Group', 'group', Group::class), 
            HasMany::make('Applications', 'titleApplications', TitleApplication::class), 
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
    public function actions(Request $request) {
        return [
            CreateGroupFromThisTitle::make()
                ->canSee(fn () => auth()->user()->isFaculty()), 
            RemoveAllApplications::make()
                ->canSee(fn () => auth()->user()->isFaculty()), 
            SendApplication::make()
                ->canSee(fn () => auth()->user()->isStudent() && ! \App\Models\TitleApplication::whereStudentId(auth()->id())->whereTitleId($this->id)->exists()),
        ];
    }
}
