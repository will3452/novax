<?php

namespace App\Observers;

use App\Models\Asset;

class AssetObserver
{
    public function creating(Asset $asset)
    {
        $asset->user_id = auth()->id() ?? 1;
    }
}
