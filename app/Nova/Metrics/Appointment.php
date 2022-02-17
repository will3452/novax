<?php

namespace App\Nova\Metrics;

use App\Models\Appointment as AppointmentModel;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Http\Requests\NovaRequest;

class Appointment extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, AppointmentModel::class, 'status')
            ->colors([
                AppointmentModel::STATUS_APPROVED => '#ABD1C4',
                AppointmentModel::STATUS_COMPLETED => '#FaFAaF',
                AppointmentModel::STATUS_PENDING => '#D8A1A6',
            ]);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'appointment';
    }
}
