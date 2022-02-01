<?php

namespace App\Nova;

use App\Models\Answer as ModelsAnswer;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Answer extends Resource
{
    public static $displayInNavigation = false;

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        if(is_null(request()->viaResourceId)) return;

        return '/resources/questions/'.request()->viaResourceId;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Answer::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'value';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'value',
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
            Date::make('Created At')
                ->exceptOnForms()
                ->sortable(),

            BelongsTo::make('Question', 'question', Question::class)
                ->rules(['required']),

            Select::make('Type')
                ->options([
                    ModelsAnswer::TYPE_CORRECT => ModelsAnswer::TYPE_CORRECT,
                    ModelsAnswer::TYPE_WRONG => ModelsAnswer::TYPE_WRONG,
                ]),

            Text::make('Answer', 'value')
                ->rules(['required']),
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