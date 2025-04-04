<?php

namespace App\Nova\Metrics;

use App\Models\Branch;
use App\Models\Sale;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Http\Requests\NovaRequest;

class DailyBranchCost extends Value
{
    public $branchId;
    public function name()
    {
        return Branch::find($this->branchId)->name . "'s Cost";
    }
    public function __construct($branchId)
    {
        $this->branchId = $branchId;
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->sum(
            $request,
            Sale::whereBranchId($this->branchId)->whereStatus('CONFIRMED'),
            'total_cost',
            'date')->currency('₱')->format('0.0');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            'TODAY' => __('Today'),
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
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
        return 'daily-branch-cost-' . $this->branchId;
    }
}
