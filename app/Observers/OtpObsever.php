<?php

namespace App\Observers;

use App\Mail\EmailVerificationCode;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;

class OtpObsever
{
    public function creating(Otp $otp){
        $otp->otp = rand(1000,9999);
    }

    public function created(Otp $otp)
    {
        Mail::to($otp->email)->send(new EmailVerificationCode($otp));
    }
}
