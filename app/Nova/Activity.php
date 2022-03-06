<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laraning\NovaTimeField\TimeField;
use App\Models\Activity as ModelsOutput;
use App\Models\Activity as ModelsActivity;
use App\Nova\Filters\ActivityCategory;
use App\Nova\Filters\ActivityType;
use DateTime;
use Epartment\NovaDependencyContainer\HasDependencies;
use Laravel\Nova\Http\Requests\NovaRequest;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\DateTime as FieldsDateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;

class Activity extends Resource
{
    use HasDependencies;
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Activity::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'module_id',
        'created_at',
        'name',
        'type',
        'category',
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
            Date::make('Uploaded At', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make('Module', 'module', Module::class),
            Text::make('Name')
                ->rules(['required']),
            Select::make('Category')
                ->options([
                    ModelsOutput::CATEGORY_EXAM => ModelsOutput::CATEGORY_EXAM,
                    ModelsOutput::CATEGORY_PROJECT => ModelsOutput::CATEGORY_PROJECT,
                    ModelsOutput::CATEGORY_QUIZ => ModelsOutput::CATEGORY_QUIZ,
                ])->rules(['required']),
            // Select::make('Type')
            //     ->options([
            //         ModelsOutput::TYPE_ASYNCHRONOUS => ModelsOutput::TYPE_ASYNCHRONOUS,
            //         ModelsOutput::TYPE_SYNCHRONOUS => ModelsOutput::TYPE_SYNCHRONOUS,
            //     ])->rules(['required']),
            NovaDependencyContainer::make([
                Text::make('Time Limit', 'time_limit')
                    ->help('format: (HH:MM:SS)')
                    ->onlyOnForms(),
                Text::make('Time Limit', function () {
                    return $this->time_limit->format('H:i:s');
                })->exceptOnForms(),
            ])
                ->help('In Hour')
                ->dependsOnNot('category', ModelsOutput::CATEGORY_PROJECT),
            NovaDependencyContainer::make([
                Textarea::make('Instructions', 'instruction')
                    ->alwaysShow()
                    ->rules(['required']),
                FieldsDateTime::make('Deadline')
                    ->rules(['required', 'after:now']),
            ])->dependsOn('category', ModelsOutput::CATEGORY_PROJECT),
            HasMany::make('Questions', 'questions', Question::class)
                ->canSee(fn () => $this->category !== ModelsActivity::CATEGORY_PROJECT)
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
        return [
            (new ActivityCategory()),
            (new ActivityType()),
        ];
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
