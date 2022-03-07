<?php

namespace App\Nova;

use App\Helpers\Model;
use App\Models\User;
use App\Models\YearLevel;
use App\Nova\Actions\AddStudents;
use App\Nova\Traits\HideTrait;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\MultiselectField\Multiselect;

class Room extends Resource
{
    use HideTrait;

    const hideToUserType = Model::forPartners;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Room::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            Text::make('Code')
                ->exceptOnForms(),
            Select::make('Year Level')
                ->options(YearLevel::get()->pluck('name', 'name'))
                ->rules(['required']),
            BelongsTo::make('Teacher', 'teacher', \App\Nova\User::class)
                ->exceptOnForms(),
            Select::make('Teacher', 'teacher_id')
                ->onlyOnForms()
                ->options(User::whereType(User::TYPE_TEACHER)->whereDoesntHave('room')->get()->pluck('name', 'id'))
                ->rules(['required']),

            HasMany::make('Students', 'studentRooms', StudentRoom::class),
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
        return [
            (new AddStudents())
                ->onlyOnDetail(),
        ];
    }
}
