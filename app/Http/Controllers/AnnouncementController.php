<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Profile;
use App\Models\SMSCredit;
use Exception;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index (Request $request) {
        $announcements = Announcement::get();
        if ($request->has('archive')) {
            $announcements = Announcement::onlyTrashed()->get();
        }

        return view('announcements', compact('announcements'));
    }

    public function sendSMS($message, $phone) {
        try {
            $ch = curl_init();
            $parameters = array(
                'apikey' => env('SEMAPHORE_APIKEY'), //Your API KEY
                'number' => $phone,
                'message' => $message,
                'sendername' => 'SEMAPHORE'
            );
            curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
            curl_setopt( $ch, CURLOPT_POST, 1 );

            //Send the parameters set above with the request
            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

            // Receive response from server
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
            curl_close ($ch);

            //Show the server response
            echo $output;
        } catch (Exception $e) {
            return null;
        }
    }

    public function store(Request $request) {
        $credits = SMSCredit::first();

        if (! $credits->credit && $request->with_sms) {
            alert()->warning('No load credit!');

            return back();
        }
        // return $request->all();
        $data = $request->validate([
            'title' => 'required',
            'details' => 'required'
        ]);
        $data['user_id'] = auth()->id();

        Announcement::create($data);
        // get profiles
        $profiles = Profile::select('cpno')->get()->map( fn ($e) => $e->cpno)->all();

        $this->sendSMS($data['details'], implode(',', $profiles));

        alert()->success('Announcement has been broadcasted!');

        return back();
    }
}
