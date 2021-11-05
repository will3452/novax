<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $pi = pi();
        $x = sin($latitudeFrom * $pi/180) *
        sin($latitudeTo * $pi/180) +
        cos($latitudeFrom * $pi/180) *
        cos($latitudeTo * $pi/180) *
        cos(($longitudeTo * $pi/180) - ($longitudeFrom * $pi/180));
        $x = atan((sqrt(1 - pow($x, 2))) / $x);
        return abs((1.852 * 60.0 * (($x/$pi) * 180)) / 1.609344) * 1.60934; //km
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $shops = null;

        if (request()->status == 'all' || !request()->has('status')) {
            $shops = Shop::get();
        } else {
            $shops = Shop::where('status', request()->status)->get();
        }

        $limit = request()->limit ?? 10;

        if (request()->has('lng') && request()->has('lat')) {
            foreach ($shops as $shop) {
                $shop->distance = number_format($this->getDistance(
                    request()->lat,
                    request()->lng,
                    $shop->lat,
                    $shop->lng
                ), 2);
            }
        }

        $shops = $shops->sortBy('distance')->take($limit);

        return view('landing', compact('shops'));
    }
}
