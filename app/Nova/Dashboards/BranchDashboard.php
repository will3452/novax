<?php

namespace App\Nova\Dashboards;

use App\Models\Branch;
use App\Nova\Metrics\BranchDailyExpenses;
use App\Nova\Metrics\BranchDailySales;
use Illuminate\Support\Str;
use Laravel\Nova\Dashboard;

class BranchDashboard extends Dashboard
{

    public $branchId;
    public static $count = 0;
    public function __construct($branchId)
    {
        $this->branchId = $branchId;
        $_branchId = $branchId;
    }

    public static function label()
    {
        return Str::singular(class_basename(get_called_class()));
    }
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new BranchDailySales($this->branchId),
            new BranchDailyExpenses($this->branchId),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'branch-dashboard' . $_branchId;
    }
}
