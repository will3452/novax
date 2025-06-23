<?php

namespace App\Nova\Metrics;

use App\Models\Sale;
use App\Models\Branch;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class PaymentPerPaymentMethod extends Value
{
    public $branchId;
    public $method;

    /**
     * Create a new metric instance.
     *
     * @param  int  $branchId
     * @param  string  $method
     */
    public function __construct(int $branchId, string $method)
    {

        $this->branchId = $branchId;
        $this->method = $method;
    }

    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        $branch = Branch::find($this->branchId);
        $branchName = $branch ? $branch->name : 'Unknown Branch';
        $methodName = Str::title(str_replace('_', ' ', $this->method)); // Format method name

        return "{$branchName}'s {$methodName}";
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
            Sale::where('branch_id', $this->branchId)
                ->where('payment_method', $this->method)
                ->where('status', 'CONFIRMED'),
            'total_amount',
            'date' // Adjust to your actual date column
        )->currency('₱')->format('0.00'); // Standard currency format
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
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        return now()->addMinutes(5); // Cache for 5 minutes
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'payment-per-payment-method-' . $this->branchId . '-' . Str::slug($this->method);
    }
}
