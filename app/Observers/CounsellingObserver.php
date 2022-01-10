<?php

namespace App\Observers;

use App\Models\Counselling;
use Illuminate\Support\Str;

class CounsellingObserver
{
    public function creating(Counselling $counselling)
    {
        $prefix = $counselling->type === Counselling::TYPE_GROUP ? 'GR' : 'IN';
        $counselling->reference_number = $prefix . '-' . now()->format('Y'). '-' .now()->format('md') . '-' . Str::padLeft(Counselling::count(), 6, '0');
    }
}
