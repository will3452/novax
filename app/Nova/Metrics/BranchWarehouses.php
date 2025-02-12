<?php

namespace App\Nova\Metrics;

use App\Models\Branch;
use App\Models\Warehouse;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Http\Requests\NovaRequest;

class BranchWarehouses extends Value
{
    public $branch;
    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        // dd($this->branch);
        return $this->result(Warehouse::whereBranchId($this->branch->id)->count());
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
        return 'branch-warehouses';
    }
}
