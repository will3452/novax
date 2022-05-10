<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\YourTemporaryPassword;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ForgotpasswordRequest;

class ApiProfileController extends Controller
{
    public function myProfile()
    {
        return auth()->user();
    }

    public function forgotpassword(ForgotpasswordRequest $r)
    {
        $r->validated();

        $user = \App\Models\User::whereEmail($r->email)->first();
        $temPassword = Str::random(16);

        $user->update([
            'password' => bcrypt($temPassword),
        ]);

        Mail::to($user)->send(new YourTemporaryPassword($temPassword));
        return 'ok';
    }

    public function updateProfile(UpdateProfileRequest $r)
    {
        $r->validated();

        if ($r->has('password')) {
            auth()->user()->update(['password' => bcrypt($r->password)]);
        }

        if ($r->has('image')) {
            $image = time();

            Image::make($r->image)
                ->encode('png', 75)
                ->resize(90, 90)
                ->save(public_path("img/products/$image.png"));

            auth()->user()->update(['image' => "img/products/$image.png"]);
        }


        auth()->user()->update([
            'name' => $r->name,
            'address' => $r->address,
            'farmers_cooperative_id' => $r->farmers_cooperative_id,
            'phone' => $r->phone,
            'store_name' => $r->store_name,
            'coordinates' => $r->coordinates,
        ]);

        return auth()->user();
    }
}
