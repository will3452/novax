<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Quiz extends Resource
{
    use CannotModifyByStudentTrait, CannotViewByStudentTrait;
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Quiz::class;

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
        'name',
        'created_at'
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
                ->exceptOnForms(),

            Text::make('Name')
                ->rules(['required']),

            BelongsTo::make('Module', 'module', Module::class)
                ->exceptOnForms(),

            BelongsTo::make('Instructor', 'user', User::class)
                ->exceptOnForms(),

            Hidden::make('user_id')
                ->default(fn () => auth()->id()),

            Hidden::make('module_id')
                ->default(fn () => request()->viaResourceId),

            MorphMany::make('Questions', 'questions', Question::class),
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
        $moduleId = (self::$model)::find($request->resourceId)->module_id;
        return [
            (new NovaBackButton())
                ->url("/resources/modules/$moduleId")
                ->onlyOnDetail(),
        ];
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
