<?php

namespace App\Nova\Dashboards;

use App\Models\Branch;
use App\Nova\Metrics\BranchDailySales;
use Laravel\Nova\Dashboard;

class SalesDashboard extends Dashboard
{
    public static function label()
    {
        return "Sales";
    }
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $branches = auth()->user()->role == \App\Models\User::ROLE_ADMIN ? Branch::get() : auth()->user()->branches;
        $cards = [];
        foreach ($branches as $b) {
            array_push($cards, new BranchDailySales($b->id));
        }
        return $cards;
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'sales-dashboard';
    }
}
