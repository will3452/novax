<?php

namespace App\Http\Controllers;

use App\Accounting;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\GeneralJournal;
use Illuminate\Support\Carbon;
use App\Models\AccountingPeriod;

class FinacialStatement extends Controller
{
    public function incomingStatement()
    {
        $period = Accounting::getAccountingPeriod();

        $start_date = Accounting::getStartDate();

        $end_date = Accounting::getEndDate();

        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');

        $revenues = Accounting::getAccounts($accountsRev);

        $expenses = Accounting::getAccounts($accountsExp);

        $totalExpenses = 0;
        $totalRevenues = 0;

        foreach ($expenses as $item) {
            $totalExpenses += ($item->debit ?? $item->credit);
        }

        foreach ($revenues as $item) {
            $totalRevenues += ($item->debit ?? $item->credit);
        }

        return view('incoming_statement', compact('period', 'expenses', 'revenues', 'totalExpenses', 'totalRevenues'));
    }

    public function ownersEquity()
    {
        $period = Accounting::getAccountingPeriod();

        $start_date = Accounting::getStartDate();

        $end_date = Accounting::getEndDate();

        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');

        $revenues = Accounting::getAccounts($accountsRev);

        $expenses = Accounting::getAccounts($accountsExp);

        $totalExpenses = Accounting::getTotal($expenses);
        $totalRevenues = Accounting::getTotal($revenues);


        $capitalName = Account::where('type', 'CAPITAL')->where('name', 'LIKE', "%capital%")->first()->name;
        $withdrawalName = Account::where('type', 'CAPITAL')->where('name', 'LIKE', "%drawing%")->first()->name;


        $capitals = GeneralJournal::where('account', $capitalName)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])->get();

        $drawings = GeneralJournal::where('account', $withdrawalName)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])->get();

        $drawingTotal = Accounting::getTotal($drawings, true);
        $capitalTotal = Accounting::getTotal($capitals, true);


        $net = $totalRevenues - $totalExpenses;

        return view('ownersEquity', compact('period', 'net', 'capitalName', 'withdrawalName', 'drawingTotal', 'capitalTotal'));
    }

    public function financialposition()
    {
        $period =Accounting::getAccountingPeriod();

        $start_date = Accounting::getStartDate();

        $end_date = Accounting::getEndDate();

        #######################assets




        $liabilitiesCurrent = Accounting::getCurrentLiabilities();
        $liabilitiesNonCurrent = Accounting::getNonCurrentLiabilities();

        $assetsCurrent =  Accounting::getCurrentAssets();
        $assetsNonCurrent =  Accounting::getNonCurrentAssets();


        //net ####################################
        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');

        $revenues = Accounting::getAccounts($accountsRev);

        $expenses = Accounting::getAccounts($accountsExp);

        $totalExpenses = Accounting::getTotal($expenses);
        $totalRevenues = Accounting::getTotal($revenues);


        $capitalName = Account::where('type', 'CAPITAL')->where('name', 'LIKE', "%capital%")->first()->name;
        $withdrawalName = Account::where('type', 'CAPITAL')->where('name', 'LIKE', "%drawing%")->first()->name;


        $capitals = GeneralJournal::where('account', $capitalName)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])->get();

        $drawings = GeneralJournal::where('account', $withdrawalName)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])->get();

        $drawingTotal = Accounting::getTotal($drawings, true);
        $capitalTotal = Accounting::getTotal($capitals, true);


        $net = $totalRevenues - $totalExpenses;

        $ownerEquity = Accounting::getOwnerEquity($capitalTotal, $net, $drawingTotal);
        $assetsCurrentTotal = Accounting::getTotal($assetsCurrent);
        $assetsNonCurrentTotal = Accounting::getTotal($assetsNonCurrent);
        $assetsTotal = ($assetsCurrentTotal + $assetsNonCurrentTotal);


        $liabilitiesCurrentTotal = Accounting::getTotal($liabilitiesCurrent);
        $liabilitiesNonCurrentTotal = Accounting::getTotal($liabilitiesNonCurrent);
        $liabilitiesTotal = ($liabilitiesCurrentTotal + $liabilitiesNonCurrentTotal) + $ownerEquity;

        $assetsCurrentGroups = $assetsCurrent->groupBy('account');
        $assetsNonCurrentGroups = $assetsNonCurrent->groupBy('account');

        $liabilitiesCurrentGroups = $liabilitiesCurrent->groupBy('account');
        $liabilitiesNonCurrentGroups = $liabilitiesNonCurrent->groupBy('account');



        return view('financialposition', compact('period', 'assetsNonCurrentTotal', 'assetsCurrentTotal', 'liabilitiesCurrentTotal', 'liabilitiesNonCurrentTotal', 'liabilitiesCurrent', 'liabilitiesNonCurrent', 'assetsCurrent', 'assetsNonCurrent', 'assetsTotal', 'ownerEquity', 'liabilitiesTotal', 'assetsCurrentGroups', 'assetsNonCurrentGroups', 'liabilitiesCurrentGroups', 'liabilitiesNonCurrentGroups'));
    }
}
