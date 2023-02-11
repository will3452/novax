<?php

namespace App\Nova;

use App\Nova\Actions\IssueDocument;
use App\Nova\Metrics\Genders;
use App\Nova\Metrics\ProfilesPerPurok;
use App\Nova\Metrics\RequestedDocuments;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Profile extends Resource
{
    public static function icon () {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 32 32" fill="currentColor" class="w-6 h-6">
        <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
      </svg>
      ';
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

    public function title () {
        return "$this->last_name, $this->first_name";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
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
            Date::make('Date','created_at')
                ->exceptOnForms()
                ->sortable(),
            Text::make('Full Name')
                ->hideFromDetail()
                ->exceptOnForms(),
            Text::make('First Name')
                ->hideFromIndex()
                ->rules(['required']),
            Text::make('Middle Name')
                ->hideFromIndex(),
            Text::make('Last Name')
                ->hideFromIndex()
                ->rules(['required']),
            Text::make('Purok')
                ->rules(['required']),
            Select::make('Gender')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ])->rules(['required']),
            Date::make('Birthdate')
                ->rules(['required']),
            Avatar::make('Image')
                ->rules(['required']),
            Text::make('Phone')
                ->rules(['max:11']),
            Image::make('Valid ID', 'valid_id')
                ->hideFromIndex()
                ->rules(['required']),
            Select::make('Civil Status')
                    ->hideFromIndex()
                    ->rules(['required'])
                    ->options([
                        'Single' => 'Single',
                        'Married' => 'Married',
                        'Widow' => 'Widow',
                    ])
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
            Genders::make()->width('1/2'),
            ProfilesPerPurok::make()->width('1/2'),
            RequestedDocuments::make($request->resourceId)->width('full')->onlyOnDetail(),
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
            ( new IssueDocument())->onlyOnTableRow(),
        ];
    }
}
