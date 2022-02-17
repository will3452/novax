<?php

namespace App\Nova\Metrics;

use App\Models\User as UserModel;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, UserModel::class, 'type')
            ->colors([
                UserModel::TYPE_PATIENT => '#ABD1C4',
                UserModel::TYPE_STAFF => '#D8A1A6',
                UserModel::TYPE_STAFF => '#DDD',
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
        return 'user';
    }
}
