<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function browse()
    {
        $offers = [];
        $skills = auth()->user()->skills()->get()->pluck('description');
        if (isset(request()->keyword)) {
            $offers = JobOffer::whereHas('tags', function ($q) use ($skills) {
                $q->whereIn('description', $skills);
            })->whereStatus(JobOffer::STATUS_OPEN)->where('position', 'LIKE', "%".request()->keyword."%")->get();
        } else {
            $offers = JobOffer::whereHas('tags', function ($q) use ($skills) {
                $q->whereIn('description', $skills);
            })->whereStatus(JobOffer::STATUS_OPEN)->get();
        }

        return view('browse-jobs', compact('offers'));
    }

    public function submitApplication()
    {
        $data = request()->validate([
            'job_offer_id' => 'required'
        ]);

        $data['applicant_id'] = auth()->id();

        $application = JobApplication::updateOrcreate($data, $data);

        return response([
            'job_application' => $application,
        ], 200);
    }
}
