<?php

namespace App\Observers;

use App\Models\Counselling;
use Illuminate\Support\Str;

class CounsellingObserver
{
    public function creating(Counselling $counselling)
    {
        $counselling->reference_number = now()->format('Y'). '-' .now()->format('md') . '-' . Str::padLeft($counselling->id, 6, '0');
    }
}
