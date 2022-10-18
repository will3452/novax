<?php

namespace App\Services;

use App\Models\SmsCredit as ModelsSmsCredit;

class SmsCredit {

    public static function latestCredit() {
        $model = ModelsSmsCredit::latest()->first();

        if (!$model) {
            $model = ModelsSmsCredit::create(['total' => 200, 'balance' => 200]);
        }
        return $model;
    }

    public static function getBalance() {
        return self::latestCredit()->balance;
    }

    public static function getTotal() {
        return self::latestCredit()->total;
    }

    public static function deduct($amount = 1) {
        $credit = self::latestCredit();
        $balance = $credit->balance - $amount;
        $credit->update(['balance' => $balance]);
    }

    public static function loadBalance($cost) {
        $credit = self::latestCredit();
        $balance = $credit->balance + $cost;
        $credit->update(['balance' => $balance]);
    }

    public static function canSend() {

        if (self::getBalance() <= 0) {
            return false;
        }

        self::deduct();

        return true;
    }
}
