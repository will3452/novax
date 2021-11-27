<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function submitResume()
    {
        $data = request()->validate([
            'file' => 'required',
        ]);

        if (auth()->user()->resume) {
            auth()->user()->resume()->update([
                'file' => $data['file']->store('public'),
            ]);
        } else {
            auth()->user()->resume()->create([
                'file' => $data['file']->store('public'),
            ]);
        }

        return back()->withSuccess('Success!');
    }
}
