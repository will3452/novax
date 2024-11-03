<?php

namespace App\Nova;

use App\Models\User as ModelsUser;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\NovaRequest;

class Borrower extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereType(ModelsUser::TYPE_USER)->whereNull('group_id');
    }

    public static function label () {
        return "Individual Borrower";
    }
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
            Text::make('ID', fn () => str_pad($this->id, 8, '0', STR_PAD_LEFT)),
            Stack::make('Details', [
                Avatar::make('Avatar')->squared(),
                    Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),
                Text::make('Phone')->rules(['max:11', 'min:11'])->help('format: 09XXXXXXXXX'),
                Hidden::make('type')
                    ->default(fn () => ModelsUser::TYPE_USER),
            ]),
            Avatar::make('Avatar')
                ->onlyOnForms()
                ->squared(),
                    Text::make('Name')
                    ->onlyOnForms()
                    ->sortable()
                    ->rules('required', 'max:255'),

            Hidden::make('type')
                ->default(fn () => ModelsUser::TYPE_USER),


            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Text::make('Phone')->rules(['max:11', 'min:11'])->help('format: 09XXXXXXXXX')->onlyOnForms(),
            Hidden::make('password')
                ->default(fn () => bcrypt('password')),
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
