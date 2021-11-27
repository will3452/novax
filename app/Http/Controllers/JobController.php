<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function browse()
    {
        $offers = JobOffer::whereStatus(JobOffer::STATUS_OPEN)->get();
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
