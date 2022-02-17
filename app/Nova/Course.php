<?php

namespace App\Nova;

use App\Models\User;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\AddStudent;
use Laravel\Nova\Fields\HasMany;
use App\Nova\Actions\ChangeStatus;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Course extends Resource
{
    public static function label()
    {
        return "Studies";
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->hasRole(User::TYPE_INSTRUCTOR)) {
            return $query->whereUserId(auth()->id());
        }

        if (auth()->user()->hasRole(User::TYPE_STUDENT)) {
            $userCourse = \App\Models\UserCourse::whereUserId(auth()->id())->get()->pluck('course_id');
            return $query->whereIn('id', $userCourse);
        }

        return $query;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Course::class;

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
        'code',
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
            Text::make('Code')
                ->sortable()
                ->rules(['required', 'unique:courses,code,{{resourceId}}']),

            Text::make('Name')
                ->sortable()
                ->rules(['required', 'unique:courses,name,{{resourceId}}']),

            Select::make('Instructor', 'user_id')
                ->onlyOnForms()
                ->options(fn () => ! auth()->user()
                    ->hasRole(\App\Models\Role::SUPERADMIN) ?
                    [auth()->id() => auth()->user()->name] :
                    User::instructors()->get()->pluck('name', 'id')
                ),

            BelongsTo::make('Instructor', 'instructor', \App\Nova\User::class)
                ->exceptOnForms(),

            Badge::make('Status')
                ->map([
                    (static::$model)::STATUS_ACTIVE => 'success',
                    (static::$model)::STATUS_INACTIVE => 'danger',
                ]),

            HasMany::make('Students', 'userCourses', UserCourse::class),

            HasMany::make('Modules', 'modules', Module::class),

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
            (new AddStudent())
                ->onlyOnDetail(),
            (new ChangeStatus)
                ->onlyOnDetail(),
        ];
    }
}
