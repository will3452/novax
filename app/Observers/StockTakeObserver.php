<?php

namespace App\Observers;

use App\Models\StockTake;

class StockTakeObserver
{
    public function creating(StockTake $stockTake)
    {
        $stockTake->user_id = auth()->id ?? 1;
    }
}
