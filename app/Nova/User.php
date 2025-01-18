<?php

namespace App\Nova;

use App\Nova\Actions\BroadcastAnnouncement;
use App\Nova\Filters\FromAge;
use App\Nova\Filters\SexFilter;
use App\Nova\Filters\StatusFilter;
use App\Nova\Filters\ToAge;
use App\Nova\Metrics\Genders;
use App\Nova\Metrics\Statuses;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class User extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
        // return $query->where('email', '!=', 'super@admin.com');
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
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->email == 'super@admin.com';
    }

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
                Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),
                Select::make('Sex')
                    ->options([
                        'male' => 'male',
                        'female' => 'female',
                    ]),
                Select::make('Status')
                    ->options([
                        'widowed' => 'widowed',
                        'single' => 'single',
                        'married' => 'married',
                    ]),
                Date::make('Birthday', ),
                Number::make('Age')
                    ->exceptOnForms(),
            ]),
            Panel::make('Contact Information', [
                Text::make('Email')
                        ->sortable()
                        ->rules('required', 'email', 'max:254')
                        ->creationRules('unique:users,email')
                        ->updateRules('unique:users,email,{{resourceId}}'),

                Number::make('Phone', 'phone')->rules(['required', 'max:99999999999']),
            ]),


            Panel::make('Security Information', [
                Password::make('Password')
                    ->onlyOnForms()
                    ->creationRules('required', 'string', 'min:8')
                    ->updateRules('nullable', 'string', 'min:8'),
            ]),
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
            Genders::make(),
            Statuses::make(),
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
        return [
            SexFilter::make(),
            StatusFilter::make(),
            FromAge::make(),
            ToAge::make(),
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
            BroadcastAnnouncement::make(),
        ];
    }
}
