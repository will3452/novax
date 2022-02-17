<?php

namespace App\Nova;

use App\Models\User as ModelsUser;
use App\Nova\Actions\Block;
use App\Nova\Actions\SetActive;
use App\Nova\Filters\User\Status;
use App\Nova\Filters\User\Type;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
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
            Image::make('Image')
                ->rules(['max:2000']),

            Date::make('Registered At', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Gender')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female'
                ])->rules(['required']),

            Date::make('BirthDate', 'birth_date')
                ->rules(['required']),

            Text::make('Address')
                ->rules(['required']),

            Select::make('Type')
                ->options([
                    ModelsUser::TYPE_STAFF => ModelsUser::TYPE_STAFF,
                    ModelsUser::TYPE_PATIENT => ModelsUser::TYPE_PATIENT,
                ])->rules(['required']),

            Badge::make('Status')
                ->map([
                    ModelsUser::STATUS_ACTIVE => 'success',
                    ModelsUser::STATUS_BLOCKED => 'danger',
                    ModelsUser::STATUS_PENDING => 'warning',
                ]),

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
            (new Status),
            (new Type),
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
            (new Block),
            (new SetActive),
        ];
    }
}
