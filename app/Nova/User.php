<?php

namespace App\Nova;

use App\Models\Study;
use App\Nova\Actions\DownloadImportStudentTemplate;
use App\Nova\Actions\ImportStudent;
use App\Nova\Filters\TypeOfUser;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
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
            Select::make('Account Type', 'type')
                ->options(
                    (static::$model)::TYPE_OPTIONS,
                )->rules(['required']),

            Image::make('School picture', 'picture'),

            Select::make('Study')
                ->options(Study::get()->pluck('name', 'name'))
                ->rules(['required']),

            Text::make('School Id')
                ->sortable()
                ->rules(['required', 'unique:users,school_id,{{resourceId}}']),

            Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),

            Text::make('Email')
                ->hideFromIndex()
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

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
            (new TypeOfUser())
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
            (new DownloadImportStudentTemplate)
                ->standalone(),
            (new ImportStudent)
                ->standalone()
        ];
    }
}
