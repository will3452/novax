<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\OtpLog;
use App\Models\User;
use App\Services\SmsCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Http\Controllers\LoginController as ControllersLoginController;

class LoginController extends ControllersLoginController
{


    public function sendOtp($otp, $phone) {
        $ch = curl_init();
        $apiKey = env('SMS_KEY');
        $parameters = array(
            'apikey' => $apiKey,
            'number' => $phone,
            'message' => 'Cloud Storage: Your OTP is ' . $otp,
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

        error_log('OUTPUT >> ' . $output);

        //Show the server response
        echo $output;
    }
    public function loginWithSMS (Request $request) {
        // check it the phone is existing
        // generate otp code
        // send otp


        $request->validate(['phone' => ['required', 'max:11', 'exists:users,phone']]);

        $exists = User::wherePhone($request->phone)->exists();

        if (! $exists) {
            return back()->withError('Record not found!');
        }


        $user = User::wherePhone($request->phone)->first();


        $otp = $user->generateOtp();

        if (SmsCredit::canSend()) {
            $this->sendOtp($otp, $user->phone);
        } else {
            return 'Insufficient load balance.';
        }

        return redirect()->to(route('verify.otp', ['phone' => $user->phone]));
    }

    public function verifyOtp(Request $request) {
        if (! $request->has('phone')) {
            return redirect('/');
        }
        return view('verify_otp');
    }

    public function checkOtp(Request $request) {
        $request->validate(['otp' => ['required', 'exists:otp_logs,code']]);
        $otp = OtpLog::whereCode($request->otp)->first();
        $user = User::whereId($otp->user_id)->first();

        $otp->delete();

        Auth::loginUsingId($user->id, true);

        AuditLog::create([
            'description' => 'Successfully login.',
            'ipv4' => $request->ip(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->to('/admin/dashboards/main');
    }
}
