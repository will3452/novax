<?php

namespace App\Http\Controllers;

use App\Models\AccountingPeriod;
use Illuminate\Http\Request;
use App\Models\GeneralJournal;
use Illuminate\Support\Carbon;

class TAccountController extends Controller
{
    public function index()
    {
        $start_date = Carbon::parse(request()->from)
                             ->toDateTimeString();

        $end_date = Carbon::parse(request()->to)
                             ->toDateTimeString();
        $records =  GeneralJournal::where('account', "LIKE", "%".request()->account."%")->whereBetween('created_at', [
         $start_date, $end_date
       ])->get();
        return view('t-accounts', compact('records'));
    }

    public function trialBalance()
    {
        $period = AccountingPeriod::where('is_default', 'true')->latest()->first();
        if ($period == null) {
            return 'please set accounting period';
        }

        $start_date = Carbon::parse($period->start)
        ->toDateTimeString();

        $end_date = Carbon::parse($period->end)
                ->toDateTimeString();


        $accounts =  GeneralJournal::whereBetween('created_at', [
            $period, $end_date
          ])->get()->groupBy(function ($a) {
              return $a->account;
          });
        return view('trial_balance', compact('accounts', 'period'));
    }

    public function generalJournal()
    {
        $start_date = Carbon::parse(request()->from)
                             ->toDateTimeString();

        $end_date = Carbon::parse(request()->to)
                             ->toDateTimeString();

        $records = GeneralJournal::whereBetween('created_at', [
         $start_date, $end_date
       ])->get()->groupBy(function ($q) {
           return $q->created_at->format('Y-m-d');
       });


        return view('general_journal', compact('records'));
    }
}
