<?php

namespace App\Observers;

use App\Models\FareMatrix;
use App\Models\Terminal;

class FareMatrixObserver
{
    public function haversine($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371) {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

    
        $latDifference = $latTo - $latFrom;
        $lonDifference = $lonTo - $lonFrom;
    
        $angle = 2 * asin(sqrt(
            pow(sin($latDifference / 2), 2) +
            cos($latFrom) * cos($latTo) *
            pow(sin($lonDifference / 2), 2)
        ));
    
        return round($angle * $earthRadius, 2);
    }

    public function calculateFare($distance) {
        $ffk = nova_get_setting('ffk', 15);
        $sfk = nova_get_setting('sfk', 2.65); 
        if ($distance < 5) return $ffk; 

        $distance -= 5; 
        return round($ffk + ($distance * $sfk), 2); 
    }
    /**
     * Handle the FareMatrix "created" event.
     *
     * @param  \App\Models\FareMatrix  $fareMatrix
     * @return void
     */
    public function creating(FareMatrix $fareMatrix)
    {
        $from = Terminal::find($fareMatrix->from);
        $to = Terminal::find($fareMatrix->to); 

        $distance = $this->haversine($from->lat, $from->lng, $to->lat, $to->lng);
        $fareMatrix->km = $distance; 
        $fareMatrix->fare = $this->calculateFare($distance); 
    }

    /**
     * Handle the FareMatrix "updated" event.
     *
     * @param  \App\Models\FareMatrix  $fareMatrix
     * @return void
     */
    public function updating(FareMatrix $fareMatrix)
    {
        $from = Terminal::find($fareMatrix->from);
        $to = Terminal::find($fareMatrix->to); 

        $distance = $this->haversine($from->lat, $from->lng, $to->lat, $to->lng);
        $fareMatrix->km = $distance; 
        $fareMatrix->fare = $this->calculateFare($distance); 
    }

    /**
     * Handle the FareMatrix "deleted" event.
     *
     * @param  \App\Models\FareMatrix  $fareMatrix
     * @return void
     */
    public function deleted(FareMatrix $fareMatrix)
    {
        //
    }

    /**
     * Handle the FareMatrix "restored" event.
     *
     * @param  \App\Models\FareMatrix  $fareMatrix
     * @return void
     */
    public function restored(FareMatrix $fareMatrix)
    {
        //
    }

    /**
     * Handle the FareMatrix "force deleted" event.
     *
     * @param  \App\Models\FareMatrix  $fareMatrix
     * @return void
     */
    public function forceDeleted(FareMatrix $fareMatrix)
    {
        //
    }
}
