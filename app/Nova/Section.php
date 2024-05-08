<?php

namespace App\Nova;

use App\Models\Section as ModelsSection;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Section extends Resource
{
    public static $group = 'Manage';
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
            Hidden::make('ic_type')
                ->default(fn() => auth()->id()),
            BelongsTo::make('Creator', 'creator', User::class), 
            Password::make('Pass Code'), 
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
