<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use App\Nova\Filters\TypeOfUser;
use App\Models\User as UserModel;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Epartment\NovaDependencyContainer\HasDependencies;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class User extends Resource
{
    use HasDependencies;

    public static $group = 'access Control';
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $admins  = ['super@admin.com', 'admin@admin.com']; //registered admin
        return $query->whereNotIn('email', $admins);
    }

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
                ->required()
                ->options(UserModel::OPTION_TYPE()),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->exceptOnForms()
                ->updateRules('nullable', 'string', 'min:8'),

            Number::make('Mobile Number')
                ->help('format: 09XXXXXXXXX')
                ->rules('max:11'),

            NovaDependencyContainer::make([

                Text::make('Student ID', 'student_number')
                    ->rules(['required', 'unique:users,student_number,{{resourceId}}']),

                Select::make('Year Level')
                    ->options(\App\Models\YearLevel::get()->pluck('description', 'description'))
                        ->rules(['required']),

            ])->dependsOn('type', UserModel::TYPE_STUDENT),

            Text::make('Address'),

            // Text::make('Guardian'),

            MorphToMany::make('Roles', 'roles', Role::class),

            HasOne::make('Parent', 'userParent', UserStudent::class)
                ->canSee(fn () => $this->type === (static::$model)::TYPE_STUDENT),
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
            TypeOfUser::make(),
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
            (new DownloadExcel())
        ];
    }
}
