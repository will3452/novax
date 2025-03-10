<?php

use App\Models\Expenses;
use Carbon\Carbon;

if (! function_exists('isProduct')) {
    function isProduct($item) {
        return $item->salable_type == "App\Models\Product";
    }
}

if (! function_exists('isTire')) {
    function isTire($item) {
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
        return $item->salable->category == 'OTHERS';
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
