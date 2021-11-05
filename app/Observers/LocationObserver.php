<?php

namespace App\Observers;

use App\Models\Location;

class LocationObserver
{
    public function creating(Location $location)
    {
        $location->user_id = auth()->id() ?? 1;
    }
}
