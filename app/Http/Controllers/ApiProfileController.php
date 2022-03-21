<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UpdateProfileRequest;

class ApiProfileController extends Controller
{
    public function myProfile()
    {
        return auth()->user();
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
                ->resize(75, 150)
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
