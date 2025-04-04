<?php

use App\Models\Expenses;
use App\Models\SaleItem;
use Carbon\Carbon;

if (! function_exists('isProduct')) {
    function isProduct($item) {
        return $item->salable_type == "App\Models\Product";
    }
}

if (! function_exists('isService')) {
    function isService($item) {
        return $item->salable_type == "App\Models\Service";
    }
}

if (! function_exists('isTire')) {
    function isTire(SaleItem $item) {
        if (! isProduct($item)) return false;
        return $item->salable->category == 'TIRE';
    }
}

if (! function_exists('isLubes')) {
    function isLubes($item) {
        if (! isProduct($item)) return false;
        return $item->salable->category == 'LUBES';
    }
}

if (! function_exists('isOthers')) {
    function isOthers($item) {
        if (! isProduct($item)) return false;
        return ! in_array($item->salable->category, ['LUBES', 'TIRE']);
    }
}

if(! function_exists('newDate')) {
    function newDate($str) {
        return Carbon::parse($str);
    }
}

if (! function_exists('getDailyExpensesOfBranch')) {
    function getDailyExpensesOfBranch(int $branchId, string $date) {
        return Expenses::whereBranchId($branchId)->whereDate('created_at', $date)->sum('amount');
    }
}

if (! function_exists('money')) {
    function money($amount, $point = 2, $sign = "₱") {
        return  $sign . number_format($amount, $point );
    }
}

if (! function_exists('getTotalSalesCostOfBranch')) {
    function getTotalSalesCostOfBranch(int $branchId, string $date) {
        $sales = \App\Models\Sale::whereBranchId($branchId)
            ->whereDate('date', $date)
            ->whereStatus('CONFIRMED')
            ->get();
        $cost = 0;
        foreach ($sales as $s) {
            foreach ($s->items as $item) {
                if (isTire($item))  $cost += $item->salable->price * $item->qty;
            }
        }
        return $cost;
    }
}

if (! function_exists('getSalesWithLessExpensesOfBranch')) {
    function getSalesWithLessExpensesOfBranch(int $branchId, string $date) {
        $expenses = getDailyExpensesOfBranch($branchId, $date);
        $totalSales = \App\Models\Sale::whereBranchId($branchId)
            ->whereDate('date', $date)
            ->whereStatus('CONFIRMED')
            ->sum('total_amount');
        return $totalSales - $expenses;
    }
}
