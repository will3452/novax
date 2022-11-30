<?php

namespace App\Nova\Metrics;

use App\Models\Transaction;
use App\Models\TransactionType;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class Expenses extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $etypes = TransactionType::whereType(TransactionType::TYPE_EXPENSES)->select('id')->get()->map ( fn ($e) => $e->id)->all();

        return $this->result(Transaction::whereIn('type_id', $etypes)->sum('amount'))->currency('₱');
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
        return 'expenses';
    }
}
