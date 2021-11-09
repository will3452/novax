<?php

namespace App\Http\Controllers;

use App\Accounting;
use App\Models\Account;
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
        $period = Accounting::getAccountingPeriod();

        $start_date = Accounting::getStartDate();

        $end_date = Accounting::getStartDate();

        $accounts =  Accounting::getTrialAccounts();

        return $accounts;

        return view('trial_balance', compact('accounts', 'period'));
    }

    public function generalJournal()
    {
        $start_date = Carbon::parse(request()->from)
                             ->toDateTimeString();

        $end_date = Carbon::parse(request()->to)
                             ->toDateTimeString();

        $records = Accounting::getGeneralJournal($start_date, $end_date);

        return view('general_journal', compact('records'));
    }
}
