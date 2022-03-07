<?php

namespace App\Nova;

use App\Models\User as ModelsUser;
use App\Models\UserType;
use App\Models\YearLevel;
use App\Nova\Actions\AssignParent;
use App\Nova\Actions\AssignStudents;
use App\Nova\Filters\UserType as UserTypeFilter;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    use HasDependencies;

    public function authorizedToUpdate(Request $request)
    {
        return true;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('email', '!=', 'super@admin.com');
    }

    public static $group = 'Data';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email',
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

            Select::make('Type')
                ->options(array_merge([
                    \App\Models\User::TYPE_PARENT => \App\Models\User::TYPE_PARENT,
                    \App\Models\User::TYPE_STUDENT => \App\Models\User::TYPE_STUDENT,
                    \App\Models\User::TYPE_PARTNER => \App\Models\User::TYPE_PARTNER,
                    \App\Models\User::TYPE_TEACHER => \App\Models\User::TYPE_TEACHER,
                ], UserType::get()->pluck('name', 'name')->toArray())),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->exceptOnForms()
                ->updateRules('nullable', 'string', 'min:8'),

            Number::make('Phone #', 'phone')
                ->rules('max:11'),

            Text::make('Address')
                ->rules(['required']),

            NovaDependencyContainer::make([
                Select::make('Year Level')
                    ->rules(['required'])
                    ->options(YearLevel::get()->pluck('name', 'name')),

                Text::make('Student ID', 'student_number')
                    ->rules(['required', 'unique:users,student_number,{resourceId}']),
            ])->dependsOn('type', \App\Models\User::TYPE_STUDENT),

            HasMany::make('Students', 'students', StudentParent::class)->canSee(fn () => $this->type === ModelsUser::TYPE_PARENT),

            HasOne::make('Parent', 'parent', StudentParent::class)->canSee(fn () => $this->type === ModelsUser::TYPE_STUDENT),

            // MorphToMany::make('Roles', 'roles', Role::class),
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
            (new UserTypeFilter()),
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
        return [
            (new AssignParent)
                ->canSee(fn () => (($this->type === ModelsUser::TYPE_STUDENT && ! $this->parent()->count()) || $request->has('action'))),
            (new AssignStudents)
                ->canSee(fn () => (($this->type === ModelsUser::TYPE_PARENT) || $request->has('action'))),
        ];
    }
}
