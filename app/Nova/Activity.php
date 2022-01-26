<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Nova\Actions\CloseNow;
use App\Nova\Actions\OpenAgain;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\SubmitActivity;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Activity extends Resource
{
    use CannotModifyByStudentTrait;

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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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

            Text::make('Instructions / Descriptions', 'name')
                ->rules(['required']),

            BelongsTo::make('Module', 'module', Module::class)
                ->onlyOnIndex(),

            BelongsTo::make('Instructor', 'user', User::class)
                ->exceptOnForms(),

            Badge::make('Status')
                ->map([
                    (self::$model)::STATUS_OPEN => 'success',
                    (self::$model)::STATUS_CLOSED => 'danger',
                ]),

            HasMany::make('Submissions', 'submissions', UserActivity::class),

            Hidden::make('user_id')
                ->default(fn () => auth()->id()),

            Hidden::make('module_id')
                ->default(fn () => request()->viaResourceId),
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
        return [
            (new NovaBackButton())
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
            (new SubmitActivity())
                ->showOnTableRow()
                ->canSee(fn ($request) =>
                    ($this->isOpen() || $request->has('action')) &&
                    auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT) &&
                    ! (\App\Models\UserActivity::whereActivityId($this->id)
                        ->whereUserId(auth()->id())
                        ->count())
                ),
        ];
    }
}
