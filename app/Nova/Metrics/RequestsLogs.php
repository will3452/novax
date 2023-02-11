<?php

namespace App\Nova\Metrics;

use App\Models\RequestLog;
use Illuminate\Support\Str;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Http\Requests\NovaRequest;

class RequestsLogs extends Partition
{
    public $s;
    public function __construct($s = true)
    {
        $this->s = $s;
    }
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, RequestLog::class, 'document')->label(function ($item) {
            if (! $this->s) {
                return $item;
            }
            if (strlen($item) > 7) {
                return Str::limit($item, 7);
            }

            return $item;
        });
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
        return 'requests-logs';
    }
}
