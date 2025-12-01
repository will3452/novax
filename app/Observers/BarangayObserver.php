<?php

namespace App\Observers;

use App\Models\Barangay;

class BarangayObserver
{
    /**
     * Handle the Barangay "created" event.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return void
     */
    public function created(Barangay $barangay)
    {
        [$city, $province, $region] = explode(", ", $barangay->address_line);
        // dd($barangay);
        $barangay->region = $region;
        $barangay->province = $province;
        $barangay->city = $city;
        $barangay->save();
    }

    /**
     * Handle the Barangay "updated" event.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return void
     */
    public function updated(Barangay $barangay)
    {
        [$city, $province, $region] = explode(", ", $barangay->address_line);
        if ($city != $barangay->city) {
            $barangay->city = $city;
            $barangay->save();
        } elseif ($province != $barangay->province) {
            $barangay->province = $province;
            $barangay->save();
        } elseif ($region != $barangay->region) {
            $barangay->region = $region;
            $barangay->save();
        }
    }

    /**
     * Handle the Barangay "deleted" event.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return void
     */
    public function deleted(Barangay $barangay)
    {
        //
    }

    /**
     * Handle the Barangay "restored" event.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return void
     */
    public function restored(Barangay $barangay)
    {
        //
    }

    /**
     * Handle the Barangay "force deleted" event.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return void
     */
    public function forceDeleted(Barangay $barangay)
    {
        //
    }
}
