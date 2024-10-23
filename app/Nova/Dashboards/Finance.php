<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\ExpensesMetric;
use App\Nova\Metrics\ExpensesPerCategory;
use App\Nova\Metrics\OfferingsMetric;
use App\Nova\Metrics\TithesMetric;
use Laravel\Nova\Dashboard;

class Finance extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            TithesMetric::make(),
            ExpensesMetric::make(),
            OfferingsMetric::make(),
            ExpensesPerCategory::make(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'finance';
    }
}
