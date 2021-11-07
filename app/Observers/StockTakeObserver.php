<?php

namespace App\Observers;

use App\Models\StockReport;
use App\Models\StockTake;

class StockTakeObserver
{
    public function creating(StockTake $stockTake)
    {
        $stockReport = StockReport::whereDate('created_at', now()->format('Y-m-d'))
        ->where('user_id', auth()->id() ?? 1)
        ->first();

        if (is_null($stockReport)) {
            $stockReport = StockReport::create([
                'user_id'=>auth()->id() ?? 1,
                'saved_at'=>now(),
            ]);
        }
        $stockTake->user_id = auth()->id() ?? 1;
        $stockTake->stock_report_id = $stockReport->id;
    }
}
