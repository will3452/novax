<?php

namespace App\Nova;

use App\Models\Record as ModelsRecord;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Record extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Record::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'created_at';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'created_at',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        /**
     'fasp_control_number',
        'fas_control_number',
        'job_type',
        'job_status',
        'fas_pic',
        'maker',
        'received_date',
        'fas_due_date',
        'fasp_due_date',
        'date_send',
        'status',
        'working_hours',
        'standard_time',
     **/
        return [
            Text::make('FASP Control No.', 'fasp_control_number')
                ->rules(['required'])
                ->sortable(),

            Text::make('FAS Control No.', 'fas_control_number')
                ->rules(['required'])
                ->sortable(),

            Text::make('Job Type', 'job_type')
                ->rules(['required'])
                ->sortable(),


            Select::make('Job Status')
                ->rules(['required'])
                ->options([
                    ModelsRecord::JOB_STATUS_NO_PROBLEM => ModelsRecord::JOB_STATUS_NO_PROBLEM,
                    ModelsRecord::JOB_STATUS_WITH_PROBLEM => ModelsRecord::JOB_STATUS_WITH_PROBLEM,
                ]),

            Text::make('FAS PIC', 'fas_pic')
                ->rules(['required']),

            Text::make('Maker')
                ->rules(['required']),

            Date::make('Received Date'),

            Date::make('FAS Due Date', 'fas_due_date'),

            Date::make('FASP Due Date', 'fasp_due_date'),

            Date::make('Date Send', 'date_send'),

            Select::make('Status')
                ->rules(['required'])
                ->options([
                    ModelsRecord::STATUS_ON_GOING => ModelsRecord::STATUS_ON_GOING,
                    ModelsRecord::STATUS_PENDING => ModelsRecord::STATUS_PENDING,
                    ModelsRecord::STATUS_SENT => ModelsRecord::STATUS_SENT,
                ]),

            Number::make('Working Hours')
                ->rules(['required']),

            Number::make('Standard Time')
                ->rules(['required']),
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
