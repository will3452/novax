<?php

namespace App\Nova\Dashboards;

use App\Models\Branch;
use Laravel\Nova\Dashboard;
use App\Models\PaymentMethod;
use App\Nova\Metrics\DailyBranchCost;

class CostDashboard extends Dashboard
{
    public static function label()
    {
        return "Costs";
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
            array_push($cards, new DailyBranchCost($b->id));
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
        return 'cost-dashboard';
    }
}
