<?php

namespace App\Nova\Dashboards;

use App\Models\Branch;
use Laravel\Nova\Dashboard;
use App\Models\PaymentMethod;
use App\Nova\Metrics\PaymentPerPaymentMethod;

class PaymentDashboard extends Dashboard
{
    public static function label()
    {
        return "Payments";
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
        $methods = PaymentMethod::get();
        foreach ($branches as $b) {
            foreach ($methods as $m) {
                array_push($cards, new PaymentPerPaymentMethod($b->id, $m->name));
            }
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
        return 'payment-dashboard';
    }
}
