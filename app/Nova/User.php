<?php

namespace App\Nova;

use App\Models\User as ModelsUser;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $group = '2_Manage'; 
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
            Stack::make('Details', [
                Avatar::make('Avatar')->squared(),
                    Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),
                Text::make("type", function () {
                    return "<div class='text-xs'>$this->type</div>"; 
                })->asHtml(), 
                Text::make('Phone')->rules(['max:11', 'min:11'])->help('format: 09XXXXXXXXX'), 
                Select::make('Type')
                ->onlyOnForms()
                ->options([
                    ModelsUser::TYPE_ADMINISTRATOR => ModelsUser::TYPE_ADMINISTRATOR, 
                    ModelsUser::TYPE_USER => ModelsUser::TYPE_USER, 
                ]), 
            ]),

            
            Avatar::make('Avatar')
                ->onlyOnForms()
                ->squared(),
                    Text::make('Name')
                    ->onlyOnForms()
                    ->sortable()
                    ->rules('required', 'max:255'),

            Select::make('Type')
                ->onlyOnForms()
                ->options([
                    ModelsUser::TYPE_ADMINISTRATOR => ModelsUser::TYPE_ADMINISTRATOR, 
                    ModelsUser::TYPE_USER => ModelsUser::TYPE_USER, 
                ]), 
            

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Text::make('Phone')->rules(['max:11', 'min:11'])->help('format: 09XXXXXXXXX')->onlyOnForms(), 

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
            
            KeyValue::make('Demographic'), 
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
