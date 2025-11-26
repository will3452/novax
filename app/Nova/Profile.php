<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Profile extends Resource
{
    public static function group () {
        return 'Manage';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Profile::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = '';

    public function title () {
        $name = '';
        if ($this->first_name) {
            $name .= $this->first_name;
        }

        if ($this->middle_name) {
            $name .= " " .$this->middle_name[0] . ".";
        }

        if ($this->last_name) {
            $name .= " " . $this->last_name;
        }

        if ($this->suffix) {
            $name .= " $this->suffix";
        }

        return $name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'first_name',
        'last_name',
        'middle_name',
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
            Text::make('First Name')
                ->rules(['required']),
            Text::make('Middle Name'),
            Text::make('Last Name')
                ->rules(['required']),
            Select::make('Suffix')
                ->options(array_combine(\App\Models\Profile::SUFFIX, \App\Models\Profile::SUFFIX)),
            Date::make('Birth Date')
                ->rules(['required']),
            Select::make('Gender')
                ->options([
                    \App\Models\Profile::GENDER_MALE => \App\Models\Profile::GENDER_MALE,
                    \App\Models\Profile::GENDER_FEMALE =>
                    \App\Models\Profile::GENDER_FEMALE,
                ]),
            Text::make('Address'),
            BelongsTo::make('User', 'user')
                ->help('Defines the system-level account associated with this profile, determining permissions, login credentials, and access rights.'),
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
