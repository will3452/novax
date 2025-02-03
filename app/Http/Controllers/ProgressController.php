<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'section_id' => ['required'],
            'group_id' => ['required'],
            'week' => ['required'],
            'from_date' => ['required'],
            'to_date' => ['required'],
            'description' => ['required'],
        ]);

        Progress::create($data);
        alert()->success('Success', 'Progress Report has been submitted.');
        return back();
    }
}
