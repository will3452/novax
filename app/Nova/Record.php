<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use App\Models\Record as ModelsRecord;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Record extends Resource
{
    public static $group = 'Management';
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
        return [
            Tabs::make('Records', [
                Tab::make(
                    'Record Details',
                    [
                    Text::make('Company Ctrl No.', 'company_control_number')
                        ->rules(['required'])
                        ->sortable(),

                    Text::make('Customer Ctrl No.', 'customer_control_number')
                        ->rules(['required'])
                        ->sortable(),

                    Text::make('Job Type', 'job_type')
                        ->rules(['required'])
                        ->sortable(),

                    Select::make('Job Status')
                        ->onlyOnForms()
                        ->rules(['required'])
                        ->options([
                            ModelsRecord::JOB_STATUS_NO_PROBLEM => ModelsRecord::JOB_STATUS_NO_PROBLEM,
                            ModelsRecord::JOB_STATUS_WITH_PROBLEM => ModelsRecord::JOB_STATUS_WITH_PROBLEM,
                        ]),

                    Badge::make('Job Status')
                        ->map([
                            ModelsRecord::JOB_STATUS_NO_PROBLEM => 'success',
                            ModelsRecord::JOB_STATUS_WITH_PROBLEM => 'danger',
                        ]),

                    Text::make('Maker')
                        ->rules(['required']),

                    Date::make('Received Date'),

                    Date::make('Company Due Date', 'company_due_date'),

                    Date::make('Customer Due Date', 'customer_due_date'),

                    Date::make('Date Send', 'date_send'),

                    Badge::make('Status')
                        ->map([
                            ModelsRecord::STATUS_ON_GOING => 'info',
                            ModelsRecord::STATUS_PENDING => 'warning',
                            ModelsRecord::STATUS_SENT => 'success',
                        ]),

                    Number::make('Standard Time (hours)', 'standard_time')
                        ->rules(['required']),
                    ]
                ),

                HasMany::make('Person In-Charge', 'userRecords', UserRecord::class),

            ])->withToolbar(),
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
