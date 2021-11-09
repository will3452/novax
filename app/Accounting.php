<?php

namespace App;

use App\Models\Account;
use App\Models\GeneralJournal;
use Illuminate\Support\Carbon;
use App\Models\AccountingPeriod;

class Accounting
{
    public static function getAccountingPeriod()
    {
        $period =  AccountingPeriod::where('is_default', true)->latest()->first();
        if (is_null($period)) {
            return 'please set accounting period';
        }

        return $period;
    }

    public static function getCurrentAssets()
    {
        $assetsAccountCurrent = Account::where('type', "ASSETS (current)", )->pluck('name');

        return self::getAccounts($assetsAccountCurrent);
    }

    public static function getNonCurrentAssets()
    {
        $assetsAccountNonCurrent = Account::where('type', "ASSETS (non current)")->pluck('name');

        return self::getAccounts($assetsAccountNonCurrent);
    }

    public static function getCurrentLiabilities()
    {
        $liabiltyAccountCurrent = Account::where('Type', "LIABILITIES (current)")->pluck('name');

        return self::getAccounts($liabiltyAccountCurrent);
    }

    public static function getNonCurrentLiabilities()
    {
        $liabiltyAccountNonCurrent = Account::where('Type', "LIABILITIES (non current)")->pluck('name');

        return self::getAccounts($liabiltyAccountNonCurrent);
    }

    public static function getCurrentRatio()
    {
        return self::getTotal(self::getCurrentAssets()) / self::getTotal(self::getCurrentLiabilities());
    }


    public static function getStartDate()
    {
        return Carbon::parse(self::getAccountingPeriod()->start)
        ->toDateTimeString();
    }

    public static function getEndDate()
    {
        return Carbon::parse(self::getAccountingPeriod()->end)
        ->toDateTimeString();
    }

    public static function getTrialAccounts()
    {
        return GeneralJournal::whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->get()->groupBy(function ($a) {
              return $a->account;
          });
    }

    public static function getTrialAccount($account)
    {
        return GeneralJournal::whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->where('account', $account)->get();
    }

    public static function getCashTotal()
    {
        $accounts = GeneralJournal::whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->where('account', 'cash')->get();
        $debit = $accounts->sum('debit');
        $credit = $accounts->sum('credit');
        return $debit - $credit;
    }

    public static function getInventories()
    {
        $name = Account::where('type', 'ASSETS (current)')->where('name', 'LIKE', "%inventory%")->get()->pluck('name');
        $accounts = self::getAccounts($name);
        return $accounts;
    }

    public static function getQuickAssets()
    {
        $inventoriesTotal = self::getTotal(self::getInventories());
        $currentAssetTotal = self::getTotal(self::getCurrentAssets());
        return  $currentAssetTotal - $inventoriesTotal;
    }

    public static function getCashRatio()
    {
        return self::getCashTotal() / self::getTotal(self::getCurrentLiabilities());
    }

    public static function getAcidRatio()
    {
        return self::getQuickAssets() / self::getTotal(self::getCurrentLiabilities());
    }

    public static function getGeneralJournal($start, $end)
    {
        return GeneralJournal::whereBetween('created_at', [
            $start, $end
          ])->get()->groupBy(function ($q) {
              return $q->general_journal_remark_id;
          });
    }

    public static function getAccounts($accounts) // array
    {
        return GeneralJournal::whereIn('account', $accounts)->whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->get();
    }

    public static function getTotal($items, $normal=false)
    {
        $total = 0;
        if ($normal) {
            foreach ($items as $item) {
                $total += $item->debit ?? $item->credit;
            }
        } else {
            $debit = 0;
            $credit = 0;
            foreach ($items as $item) {
                if ($item->debit) {
                    $debit += $item->debit;
                } else {
                    $credit += $item->credit;
                }
            }
            $total = $debit - $credit;
        }
        return $total;
    }


    public static function getOwnerEquity($capital, $net, $drawing)
    {
        return ($capital + $net) - $drawing;
    }
}