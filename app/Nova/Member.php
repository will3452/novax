<?php

namespace App\Nova;

use App\Nova\Actions\ImportMember;
use App\Nova\Actions\UpdateProgressStatus;
use App\Nova\Actions\UpdateProperty;
use App\Nova\Filters\FilterByProgressStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Member extends Resource
{

    public static $group = 'Manage';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Member::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "$this->last_name, $this->first_name $this->middle_name";
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
                ->rules(['required'])
                ->sortable(),
            Text::make('Last Name')
                ->rules(['required'])
                ->sortable(),
            Text::make('Middle Name')->sortable(),
            Date::make('Birthday')->sortable(),
            Select::make('Address')
                ->sortable()
                ->options(fn () => \App\Models\Address::get()->pluck('name', 'name')),
            Text::make('Email')->hideFromIndex(),
            Text::make('Phone')->hideFromIndex(),
            Select::make('Gender')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ])
                ->rules(['required']),
            Date::make('Date Joined')
                ->hideFromIndex()
                ->sortable(),
            Text::make('Profession')->sortable(),
            Select::make('Status')
                ->options([
                    'active' => 'active',
                    'in-active' => 'in-active',
                ]),
            Text::make('Att. Count', function () {
                return \App\Models\Attendance::whereMemberId($this->id)->count();
            }),
            Select::make('Progress Status')
                ->sortable()
                ->options([
                    'Regular' => 'Regular',
                    '1st' => '1st',
                    '2nd' => '2nd',
                    '3rd' => '3rd',
                    '4th' => '4th',
                ]),
            HasMany::make('Attendances', 'attendances', Attendance::class),
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
            FilterByProgressStatus::make(),
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
            ImportMember::make()
                ->standalone(),
            UpdateProgressStatus::make(),
            UpdateProperty::make(),
        ];
    }
}
