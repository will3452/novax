<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use App\Nova\Filters\UserType;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use App\Models\User as ModelsUser;
use App\Nova\Actions\DownloadTemplate;
use App\Nova\Actions\ImportUsers;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class User extends Resource
{
    use HasDependencies;    
    public static $group = 'Administration'; 

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('email', '!=', 'super@admin.com');
    }

    public static function availableForNavigation(Request $request)
    {
        return ! auth()->user()->isStudent(); 
    }

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

            Text::make('Type', function () {
                if ($this->id == nova_get_setting('coordinator_id'))  return "$this->type / Coordinator"; 
                return $this->type; 
            })
                ->exceptOnForms(), 

            Select::make('Type')
                ->onlyOnForms()
                ->hideWhenUpdating()
                ->options([
                    ModelsUser::TYPE_DEAN =>  ModelsUser::TYPE_DEAN,
                    ModelsUser::TYPE_STUDENT =>  ModelsUser::TYPE_STUDENT,
                    ModelsUser::TYPE_FACULTY =>  ModelsUser::TYPE_FACULTY,
                ]), 

            Text::make('Name')
                ->help('SURNAME, GIVEN NAME MI.')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('ID no.', 'number')->hideWhenUpdating(), 

            NovaDependencyContainer::make([
                Text::make('Program of study', 'course'), 
            ])->dependsOn('type', ModelsUser::TYPE_STUDENT ), 

            NovaDependencyContainer::make([
                Text::make('Cluster'), 
            ])->dependsOn('type', ModelsUser::TYPE_DEAN ), 

            NovaDependencyContainer::make([
                Text::make('Cluster'), 
            ])->dependsOn('type', ModelsUser::TYPE_FACULTY ), 

            Image::make('Signature')->hideFromIndex()->hideWhenCreating(), 

            Text::make('Email')
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
            UserType::make(), 
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
            DownloadTemplate::make()->onlyOnIndexToolbar(), 
            ImportUsers::make()->onlyOnIndexToolbar(), 
        ];
    }
}
