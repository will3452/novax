<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\HealthProblem;
use App\Models\HeadOfTheFamily;

class HealthProblemController extends Controller
{
    public function index (Request $request) {
        $healthProblems = HealthProblem::with(['profile'])->get();
        return view('health-problems.index', compact('healthProblems'));
    }

    public function create(Request $request) {
        $profiles = Profile::get();
        return view('health-problems.create', compact('profiles'));
    }

    public function store (Request $request) {
        $data = $request->validate([
            'profile_id' => ['required', 'exists:profiles,id'],
            'HPN' => '',
            'CVD' => '',
            'cancer' => '',
            'renal' => '',
            'diabetes' => '',
            'TB' => '',
            'goiter' => '',
            'others' => '',
        ]);

        HealthProblem::create($data);

        alert()->success('Record has been added!');

        return back();
    }

    public function show(Request $request, HealthProblem $healthProblem) {
        $healthProblem->load('profile');
        return view('health-problems.show', compact('healthProblem'));
    }

    public function edit(Request $request, HealthProblem $healthProblem) {
        $profiles = Profile::get();
        return view('health-problems.update', compact('healthProblem', 'profiles'));
    }

    public function update(Request $request, HealthProblem $healthProblem)
    {
        $data = $request->validate([
            'profile_id' => ['required', 'exists:profiles,id'],
            'HPN' => '',
            'CVD' => '',
            'cancer' => '',
            'renal' => '',
            'diabetes' => '',
            'TB' => '',
            'goiter' => '',
            'others' => '',
        ]);

        $healthProblem->update($data);

        alert()->success('Record has been updated!');

        return back();
    }
}
