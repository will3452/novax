<?php

namespace App\Nova;

use App\Models\Module as ModelsModule;
use App\Nova\Actions\ChangeModuleStatus;
use Elezerk\PdfViewer\PdfViewer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Module extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Module::class;

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
        'course_id',
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
            Text::make('Document Material', fn () =>
                    "<a href='/view-module-document/$this->id' target='_blank' class='btn p-2 btn-xs btn-primary'>View</a>"
                )->onlyOnDetail()
                ->asHtml(),
            File::make('Material')
                ->onlyOnForms()
                ->disableDownload()
                ->rules(['required']),
            BelongsTo::make('Course', 'course', Course::class),
            BelongsTo::make('Instructor', 'user', User::class)
                ->exceptOnForms(),
            Badge::make('Status')
                ->map([
                    ModelsModule::STATUS_DISABLED => 'danger',
                    ModelsModule::STATUS_ENABLE => 'success',
                ]),

            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            HasMany::make('Activities', 'activities', Activity::class),
            HasMany::make('Quizzes', 'quizzes', Quiz::class),
            HasMany::make('Exams', 'exams', Exam::class),
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
        $courseId = optional((static::$model)::find($request->resourceId))->course_id;
        return [
            (new NovaBackButton())
                ->url('/resources/courses/' . $courseId)
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
        return [
            (new ChangeModuleStatus())
                ->canSee(fn ($request) => ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT))
                ->onlyOnDetail(),
        ];
    }
}
