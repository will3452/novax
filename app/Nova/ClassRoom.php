<?php

namespace App\Nova;

use App\Nova\User;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use App\Models\User as UserModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\MultiselectField\Multiselect;

class ClassRoom extends Resource
{
    public static $group = 'Data';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ClassRoom::class;



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
        'name',
        'code'
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
            Text::make('Name')
                ->rules(['required']),
            Select::make('Year Level')
                ->options(\App\Models\YearLevel::get()->pluck('description', 'description'))
                ->rules(['required']),
            Text::make('Code')->exceptOnForms(),
            BelongsTo::make('Teacher', 'teacher', User::class)
                ->exceptOnForms(),
            Select::make('Teacher', 'teacher_id')
                ->options(UserModel::availableTeacher()->get()->pluck('name', 'id'))
                ->onlyOnForms(),

            Multiselect::make('Students', 'students')
                ->belongsToMany(Student::class),

            BelongsToMany::make('Students', 'students', Student::class),
            BelongsToMany::make('Subjects', 'subjects', Subject::class),
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
