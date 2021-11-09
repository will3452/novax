<?php

namespace App\Http\Controllers;

use App\Accounting;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\GeneralJournal;
use Illuminate\Support\Carbon;
use App\Models\AccountingPeriod;
use App\Models\GeneralJournalRemark;

class TAccountController extends Controller
{
    public function index()
    {
        $start_date = Carbon::parse(request()->from)->subDay()
                             ->toDateTimeString();

        $end_date = Carbon::parse(request()->to)->addDay()
                             ->toDateTimeString();

        $records = [];
        $id = null;

        $remark = GeneralJournalRemark::whereBetween('created_at', [
            $start_date, $end_date
        ])->get();

        if ($remark) {
            $id = $remark->pluck('id');
        }

        if ($id) {
            $records =  GeneralJournal::whereIn('general_journal_remark_id', $id)->where('account', "LIKE", "%".request()->account."%")->get();
        }

        return view('t-accounts', compact('records'));
    }

    public function trialBalance()
    {
        $period = Accounting::getAccountingPeriod();

        $start_date = Accounting::getStartDate();

        $end_date = Accounting::getStartDate();

        $accounts =  Accounting::getTrialAccounts();

        return view('trial_balance', compact('accounts', 'period'));
    }

    public function generalJournal()
    {
        $start_date = Carbon::parse(request()->from)->subDay()
                             ->toDateTimeString();

        $end_date = Carbon::parse(request()->to)->addDay()
                             ->toDateTimeString();

        $records = Accounting::getGeneralJournal($start_date, $end_date);

        return view('general_journal', compact('records'));
    }
}
