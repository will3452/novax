<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\GeneralJournal;
use Illuminate\Support\Carbon;
use App\Models\AccountingPeriod;

class FinacialStatement extends Controller
{
    public function incomingStatement()
    {
        $period = AccountingPeriod::where('is_default', 'true')->latest()->first();
        if ($period == null) {
            return 'please set accounting period';
        }
        $start_date = Carbon::parse($period->start)
        ->toDateTimeString();

        $end_date = Carbon::parse($period->end)
                ->toDateTimeString();

        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');
        $revenues = GeneralJournal::whereIn('account', $accountsRev)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])
        ->get();
        $expenses = GeneralJournal::whereIn('account', $accountsExp)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])
        ->get();

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
        $period = AccountingPeriod::where('is_default', 'true')->latest()->first();
        if ($period == null) {
            return 'please set accounting period';
        }
        $start_date = Carbon::parse($period->start)
        ->toDateTimeString();

        $end_date = Carbon::parse($period->end)
                ->toDateTimeString();

        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');
        $revenues = GeneralJournal::whereIn('account', $accountsRev)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])
        ->get();
        $expenses = GeneralJournal::whereIn('account', $accountsExp)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])
        ->get();

        $totalExpenses = 0;
        $totalRevenues = 0;

        foreach ($expenses as $item) {
            $totalExpenses += ($item->debit ?? $item->credit);
        }
        foreach ($revenues as $item) {
            $totalRevenues += ($item->debit ?? $item->credit);
        }

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

        $drawingTotal = 0;
        $capitalTotal = 0;
        foreach ($drawings as $item) {
            $drawingTotal += ($item->debit + $item->credit);
        }

        foreach ($capitals as $item) {
            $capitalTotal += ($item->debit + $item->credit);
        }

        $net = $totalRevenues - $totalExpenses;

        return view('ownersEquity', compact('period', 'net', 'capitalName', 'withdrawalName', 'drawingTotal', 'capitalTotal'));
    }

    public function financialposition()
    {
        $period = AccountingPeriod::where('is_default', 'true')->latest()->first();
        if ($period == null) {
            return 'please set accounting period';
        }
        $start_date = Carbon::parse($period->start)
        ->toDateTimeString();

        $end_date = Carbon::parse($period->end)
                ->toDateTimeString();
        #######################assets
        $assetsAccount = Account::where('type', "LIKE", "%ASSET%")->pluck('name');
        $liabiltyAccount = Account::where('Type', "LIKE", "%LIABILITIES%")->pluck('name');
        ###########################Liabilities
        $liabilities =  GeneralJournal::where('account', $liabiltyAccount)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])->get();

        $assets =  GeneralJournal::where('account', $assetsAccount)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])->get();


        //net ####################################
        $accountsExp = Account::where('type', 'EXPENSES')->get()->pluck('name');
        $accountsRev = Account::where('type', 'REVENUE')->get()->pluck('name');
        $revenues = GeneralJournal::whereIn('account', $accountsRev)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])
        ->get();
        $expenses = GeneralJournal::whereIn('account', $accountsExp)
        ->whereBetween('created_at', [
            $start_date,$end_date
        ])
        ->get();

        $totalExpenses = 0;
        $totalRevenues = 0;

        foreach ($expenses as $item) {
            $totalExpenses += ($item->debit ?? $item->credit);
        }
        foreach ($revenues as $item) {
            $totalRevenues += ($item->debit ?? $item->credit);
        }

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

        $drawingTotal = 0;
        $capitalTotal = 0;
        foreach ($drawings as $item) {
            $drawingTotal += ($item->debit + $item->credit);
        }

        foreach ($capitals as $item) {
            $capitalTotal += ($item->debit + $item->credit);
        }

        $net = $totalRevenues - $totalExpenses;
        $ownerEquity = $capitalTotal + $net + $drawingTotal;

        //totals values
        $assetsTotal = 0;
        foreach ($assets as $asset) {
            $assetsTotal += ($asset->debit ?? $asset->credit);
        }

        $liabilitiesTotal = 0;
        foreach ($liabilities as $l) {
            $liabilitiesTotal += $l->debit ?? $l->credit;
        }

        $liabilitiesTotal += $ownerEquity;
        return view('financialposition', compact('period', 'liabilities', 'assets', 'assetsTotal', 'ownerEquity', 'liabilitiesTotal'));
    }
}
