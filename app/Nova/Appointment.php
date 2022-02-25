<?php

namespace App\Nova;

use App\Models\Role;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\Appointment as ModelsAppointment;
use App\Nova\Actions\MarkAsApproved;

class Appointment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Appointment::class;

    public function isAuthorized(): bool
    {
        if (auth()->user()->hasRole(\App\Models\User::ROLE_DOCTOR)) {
            return true;
        }

        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            return true;
        }

        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->hasRole(\App\Models\User::ROLE_PATIENT)) {
            return $query->wherePatientId(auth()->id());
        }

        if (auth()->user()->hasRole(\App\Models\User::ROLE_DOCTOR)) {
            return $query->whereDoctorId(auth()->id());
        }

        return $query;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true;
        }
        return is_null($this->approved_at);
    }

    public function authorizedToDelete(Request $request)
    {
        return is_null($this->approved_at);
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
            Date::make('Created Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            Badge::make('Status')
                ->map([
                    ModelsAppointment::STATUS_DECLINED => 'danger',
                    ModelsAppointment::STATUS_DONE => 'success',
                    ModelsAppointment::STATUS_PENDING => 'info',
                ]),
            DateTime::make('Date And Time', 'datetime'),
            Badge::make('Approval', fn () => is_null($this->approved_at) ? 'Not Approved' : 'Approved')
                ->map([
                    'Approved' => 'success',
                    'Not Approved' => 'danger',
                ]),
            BelongsTo::make('Patient', 'patient', User::class)
                ->exceptOnForms(),
            BelongsTo::make('Doctor', 'doctor', User::class)
                ->exceptOnForms(),
            Hidden::make('patient_id')
                ->default(fn () => auth()->id()),
            Select::make('Doctor', 'doctor_id')
                ->onlyOnForms()
                ->options(\App\Models\User::whereRole(\App\Models\User::ROLE_DOCTOR)->get()->pluck('name', 'id')),
            Textarea::make('Notes')
                ->alwaysShow()
                ->rules(['required', 'max:500'])
                ->help('maximum of 500 characters only.')
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
        $model = (self::$model)::find($request->resourceId ?? $request->resources);
        return [
            (new MarkAsApproved)
                ->onlyOnDetail()
                ->canSee(fn($request)=>optional($model)->doctor_id == auth()->id() && is_null(($model)->approved_at)),
        ];
    }
}
