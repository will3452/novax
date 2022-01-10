<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\ImportExcel;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\DownloadTemplate;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Student extends Resource
{
    public static $group = 'data';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Student::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title()
    {
        return $this->student_number . " - " . $this->full_name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'student_number',
        'first_name',
        'last_name',
        'middle_name'
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
            Text::make('Student Number')
                ->rules(['required']),

            Text::make('Full Name')
                ->sortable()
                ->exceptOnForms(),

            Text::make('First Name')
                ->rules(['required'])
                ->onlyOnForms(),

            Text::make('Middle Name')
                ->rules(['required'])
                ->onlyOnForms(),

            Text::make('Last Name')
                ->rules(['required'])
                ->onlyOnForms(),

            Text::make('Address')
                ->sortable(),

            Select::make('Gender')
                ->rules(['required'])
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ]),

            Text::make('Email')
                ->sortable(),

            Text::make('Mobile Number')
                ->sortable(),

            Date::make('BIrthdate'),

            BelongsTo::make('Course', 'course', Course::class)
                ->searchable(),

            BelongsTo::make('Branch', 'branch', Branch::class)
                ->searchable(),
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
            (new NovaBackButton())
            ->onlyOnDetail(),
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
            (new ImportExcel())->standalone(),
            (new DownloadTemplate)->standalone(),
        ];
    }
}
