<?php

namespace App\Nova;

use App\Models\User as ModelsUser;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class User extends Resource
{
    public static $group = 'Security';

    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }
    public static function authorizedToCreate(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }
    public function authorizedToDelete(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }

    public function authorizedToView(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }

    public function authorizedToUpdate(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }

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

            Panel::make('Basic Information', [
                Select::make('Type')
                    ->options([
                        ModelsUser::TYPE_PATIENT => ModelsUser::TYPE_PATIENT,
                        ModelsUser::TYPE_STAFF => ModelsUser::TYPE_STAFF,
                    ]),
                Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),
                Select::make('Sex')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
                Text::make('Address'),
                Date::make('Birthday'),
                Text::make('Phone')
                    ->help('This is required to receive SMS Notification.'),
            ]),
            Panel::make('Account Credentials', [
                Text::make('Email')
                    ->sortable()
                    ->rules('required', 'email', 'max:254')
                    ->creationRules('unique:users,email')
                    ->updateRules('unique:users,email,{{resourceId}}'),

                Password::make('Password')
                    ->onlyOnForms()
                    ->creationRules('required', 'string', 'min:8')
                    ->updateRules('nullable', 'string', 'min:8'),
            ]),
            HasMany::make('Medical Records', 'medicalRecords', MedicalRecord::class),
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
