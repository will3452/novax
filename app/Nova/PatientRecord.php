<?php

namespace App\Nova;

use App\Nova\Actions\ShowDentalChart;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class PatientRecord extends Resource
{

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereType('Patient');
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == 'Administrator';
    }
    public static $group = '1Patient Management';

    public static function label () {
        return "Patient";
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
        'id', 'name', 'email', 'gender', 'birthday'
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

            Hidden::make('type')
                ->default(fn () => 'Patient'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make('Phone'),
            Text::make('Address'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Select::make('Gender')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ]),

            Date::make('Birth Date', 'birthday'),
            (new Tabs('Records', [
                new Tab('Appointments', [
                    HasMany::make('Appointments', 'appointments', Appointment::class)
                ]),
                new Tab('Health Background', [
                    HasOne::make('Records', 'records', Record::class)
                ]),
                new Tab('Treatment History', [
                    HasMany::make('Treatments', 'treatments', Treatment::class),
                ]),
                new Tab('X-Rays', [
                    HasMany::make('Xrays', 'xrays', Xray::class)
                ]),
                new Tab('Dental Record', [
                    HasOne::make('Dental Record', 'dentalRecord', DentalRecord::class),
                ])
            ]))->withToolbar(),
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
        return [
            (new DownloadExcel())
                ->canSee(fn () => auth()->user()->type == 'Administrator')
                ->withHeadings(),
            (new ShowDentalChart()),
        ];
    }
}
