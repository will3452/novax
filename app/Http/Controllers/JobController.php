<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Builder;

class JobController extends Controller
{
    public function browse()
    {
        $offers = [];
        if (isset(request()->keyword) || isset(request()->address)) {
            $address = request()->address;
            $offers = JobOffer::whereStatus(JobOffer::STATUS_OPEN)
                ->where('position', 'LIKE', "%".request()->keyword."%")
                ->whereHas('employer', function (Builder $q) use ($address) {
                    return $q->where('address', 'LIKE', "%" . $address . "%");
                })
                ->get();
        } elseif (isset(request()->keyword)) {
            $offers = JobOffer::whereStatus(JobOffer::STATUS_OPEN)->where('position', 'LIKE', "%".request()->keyword."%")->get();
        } else {
            $offers = JobOffer::whereStatus(JobOffer::STATUS_OPEN)->get();
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
