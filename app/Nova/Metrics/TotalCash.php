<?php

namespace App\Nova\Metrics;

use App\Models\Capital;
use App\Models\Loan;
use App\Models\Payment;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Http\Requests\NovaRequest;

class TotalCash extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $revenue = Payment::sum('amount') - Loan::sum('amount');
        $totCash = Capital::sum('amount') + $revenue;
        return $this->result("$totCash")
            ->currency('₱ ')->suffix(null)->format('0,0');
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
        return 'total-cash';
    }
}
