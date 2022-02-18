<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use App\Nova\Actions\TakeNow;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Nova\Actions\CloseNow;
use Laravel\Nova\Fields\Badge;
use App\Nova\Actions\OpenAgain;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Exam extends Resource
{
    use CannotModifyByStudentTrait, CannotViewByStudentTrait;
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Exam::class;

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
        'name'
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

            BelongsTo::make('Module', 'module', Module::class)->exceptOnForms(),

            BelongsTo::make('Instructor', 'user', User::class)
                ->exceptOnForms(),

            Badge::make('Status')
                ->map([
                    (self::$model)::STATUS_OPEN => 'success',
                    (self::$model)::STATUS_CLOSED => 'danger',
                ]),

            Text::make('Score', fn () =>
                \App\Models\Attempt::whereUserId(auth()->id())
                            ->whereAttemptableType(self::$model)
                            ->whereAttemptableId($this->id)
                            ->latest()
                            ->first()->score ?? 0 . "/" .
                            \App\Models\Attempt::whereUserId(auth()->id())
                            ->whereAttemptableType(self::$model)
                            ->whereAttemptableId($this->id)
                            ->latest()
                            ->first()->number_of_items
                )
                    ->canSee(fn () =>
                        optional(
                            \App\Models\Attempt::whereUserId(auth()->id())
                            ->whereAttemptableType(self::$model)
                            ->whereAttemptableId($this->id)
                            ->latest()
                            ->first()
                        )->isDone() &&
                            auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT)
                    ),

            Hidden::make('user_id')
                ->default(fn () => auth()->id()),

            Hidden::make('module_id')
                ->default(fn () => request()->viaResourceId),

            MorphMany::make('Results', 'attempts', Attempt::class),
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
        return [
            (new TakeNow())
                ->canSee(fn () =>
                    auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT) &&
                    (
                        (
                            $this->isOpen() ||
                            $request->has('action')
                        ) &&
                        ! optional($this->attempts()->latest()->first())->isDone() &&
                        $this->questions()->count()
                    )
                )
                ->showOnTableRow(),
            (new CloseNow())
            ->showOnTableRow()
            ->canSee(fn ($request) =>
                ($this->isOpen() || $request->has('action')) &&
                    ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT)
                ),
            (new OpenAgain())
                ->showOnTableRow()
                ->canSee(fn ($request) =>
                    (! $this->isOpen() || $request->has('action')) &&
                     ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT)
            ),
        ];
    }
}
