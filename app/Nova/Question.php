<?php

namespace App\Nova;

use App\Models\Question as ModelsQuestion;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Question extends Resource
{
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Question::class;

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
        'correct_answer',
        'actual_question',
        'choices',
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
            BelongsTo::make('Activity', 'activity', Activity::class),
            Select::make('Type')
                ->options([
                    ModelsQuestion::TYPE_IDENTIFICATION => ModelsQuestion::TYPE_IDENTIFICATION,
                    ModelsQuestion::TYPE_MULTIPLECHOICE => ModelsQuestion::TYPE_MULTIPLECHOICE,
                ]),
            Textarea::make('Question', 'actual_question')
                ->alwaysShow()
                ->rules(['required']),
            Text::make('Correct Answer')
                ->rules(['required']),
            NovaDependencyContainer::make([
                Text::make('Wrong Answer #1', 'w_1')->onlyOnForms(),
                Text::make('Wrong Answer #2', 'w_2')->onlyOnForms(),
                Text::make('Wrong Answer #3', 'w_3')->onlyOnForms(),
            ])->dependsOn('type', ModelsQuestion::TYPE_MULTIPLECHOICE),

            Text::make('Choices', fn () => implode(' <br/> ', explode(ModelsQuestion::SEPARATOR, $this->choices)))->asHtml()->exceptOnForms(),
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
