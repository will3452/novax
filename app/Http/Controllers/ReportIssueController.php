<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class ReportIssueController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }


    public function create()
    {
        return view('report_issue', ['issues' => auth()->user()->issues()->latest()->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required',
            'details' => 'required',
            'attachment' => 'max:2000',
        ]);

        if (isset($data['attachment'])) {
            $data['attachment'] = $data['attachment']->store('public');
        }

        auth()->user()->issues()->create($data);

        return redirect('/home')->withSuccess('Issue Submitted!');
    }
}
