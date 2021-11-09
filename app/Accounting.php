<?php

namespace App;

use App\Models\Account;
use App\Models\GeneralJournal;
use Illuminate\Support\Carbon;
use App\Models\AccountingPeriod;
use App\Models\GeneralJournalRemark;

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

    public static function getAccountingPeriodString()
    {
        $result = self::getAccountingPeriod();
        if($result != 'please set accounting period'){
            return self::getStartDate().' '.self::getEndDate();
        }
        return $result;
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
        return Carbon::parse(self::getAccountingPeriod()->start)->subDay()
        ->toDateTimeString();
    }

    public static function getEndDate()
    {
        return Carbon::parse(self::getAccountingPeriod()->end)->addDay()
        ->toDateTimeString();
    }

    public static function getTrialAccounts()
    {
        $ids = GeneralJournalRemark::whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->get()->pluck('id');
        return GeneralJournal::whereIn('general_journal_remark_id', $ids)->get()->groupBy(function ($a) {
            return $a->account;
        });
    }

    public static function getTrialAccount($account)
    {
        $id = GeneralJournalRemark::whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->first()->id;
        return GeneralJournal::where('general_journal_remark_id', $id)->where('account', $account)->get();
    }

    public static function getCashTotal()
    {
        $ids = GeneralJournalRemark::whereBetween('created_at', [
            self::getStartDate(), self::getEndDate()
          ])->get()->pluck('id');
        $accounts = GeneralJournal::whereIn('general_journal_remark_id', $ids)->where('account', 'LIKE', "%cash%")->get();
        return self::getTotal($accounts);
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
        $ids = GeneralJournalRemark::whereBetween('created_at', [
            $start, $end
          ])->get()->pluck('id');
        return GeneralJournal::whereIn('general_journal_remark_id', $ids)->get()->groupBy(function ($q) {
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

    public static function getNetIncome()
    {
        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');

        $revenues = self::getAccounts($accountsRev);

        $expenses = self::getAccounts($accountsExp);

        $totalExpenses = self::getTotal($expenses, true);
        $totalRevenues = self::getTotal($revenues, true);

        return $totalRevenues - $totalExpenses;
    }

    public static function getTotalAssets()
    {
        $assetsCurrent =  self::getCurrentAssets();
        $assetsNonCurrent =  self::getNonCurrentAssets();

        $assetsCurrentTotal = self::getTotal($assetsCurrent);
        $assetsNonCurrentTotal = self::getTotal($assetsNonCurrent);
        $assetsTotal = ($assetsCurrentTotal + $assetsNonCurrentTotal);

        return $assetsTotal;
    }

    public static function getReturnOnAssetsRatio()//%
    {
        return (self::getNetIncome() / self::getTotalAssets()) * 100;
    }

    public static function getReturnOnEquity()
    {
        return (self::getNetIncome() / self::getCapitalTotal()) * 100;
    }

    public static function getCapitalTotal()
    {
        $capitalName = Account::where('type', 'CAPITAL')->where('name', 'LIKE', "%capital%")->first()->name;
        $withdrawalName = Account::where('type', 'CAPITAL')->where('name', 'LIKE', "%drawing%")->first()->name;


        $capitals = GeneralJournal::where('account', $capitalName)
        ->whereBetween('created_at', [
            self::getStartDate(),self::getEndDate()
        ])->get();

        $drawings = GeneralJournal::where('account', $withdrawalName)
        ->whereBetween('created_at', [
            self::getStartDate(),self::getEndDate()
        ])->get();

        $drawingTotal = self::getTotal($drawings, true);
        $capitalTotal = self::getTotal($capitals, true);

        return self::getOwnerEquity($capitalTotal, self::getNetIncome(), $drawingTotal);
    }
}
