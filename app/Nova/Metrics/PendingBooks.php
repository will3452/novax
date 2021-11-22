<?php

namespace App\Nova\Metrics;

use App\Models\Booking;
use App\Models\Role;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class PendingBooks extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $shops = auth()->user()->shops;
        $count = 0;
        foreach ($shops as $shop) {
            $count +=  $shop->bookings()->where('status', Booking::STATUS_PENDING)->count();
        }

        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            $count = Booking::whereStatus(Booking::STATUS_PENDING)->count();
        }
        return $this->result($count);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
        ];
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
        return 'pending-books';
    }
}
