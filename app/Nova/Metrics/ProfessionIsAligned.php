<?php

namespace App\Nova\Metrics;

use App\Models\ProfessionalRecord;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class ProfessionIsAligned extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, ProfessionalRecord::class, 'is_aligned')->label(function($value) {
            return $value ? 'Yes': 'No'; 
        })->colors(['#80000', '#ffc632']);  
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
        return 'profession-is-aligned';
    }
}
