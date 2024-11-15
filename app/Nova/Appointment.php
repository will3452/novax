<?php

namespace App\Nova;

use App\Models\Service;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Actions\ChangeStatus;
use App\Nova\Actions\SendReminder;
use App\Nova\Filters\Status;
use App\Rules\ConflictAppointment;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Appointment extends Resource
{

    public static function createButtonLabel()
    {
        return "Add Appointment";
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        // Customize the search logic here
        if ($request->get('search')) {
            return $query->orWhereHas('patient', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->get('search') . '%');
            });
        }

        return $query;
    }
    public static $group = '1Patient Management';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Appointment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title () {
        return $this->date->format('m/d/y');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'date',
        'service',
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
            Date::make('Date')
                ->rules(['required', 'date', 'after_or_equal:today'])
                ->required()
                ->sortable(),
            BelongsTo::make('Patient', 'patient', PatientRecord::class),
            Select::make('Slot')
                ->rules(['required', new ConflictAppointment($request->date ?? $this->date)])
                ->options(\App\Models\Appointment::getSlots()),
            // TimeField::make('Start Time', 'time_start')->withTwelveHourTime()->required(),
            // TimeField::make('End Time', 'time_end')->withTwelveHourTime()->required(),
            Textarea::make('Remarks')
                ->alwaysShow(),
            Select::make("Service")
                ->options(Service::get()->pluck('name', 'name')),
            Badge::make('Status')
                ->map([
                    'For Approval' => 'warning',
                    'Finished' => 'success',
                    'Approved' => 'info',
                    'Rejected' => 'danger',
                    'Cancelled' => 'danger',
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
            Status::make(),
            \App\Nova\Filters\Date::make(),
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
            (new DownloadExcel())
                ->withHeadings(),
            SendReminder::make()
                ->onlyOnTableRow(),
            ChangeStatus::make()
                ->onlyOnTableRow(),
        ];
    }
}
