<?php

namespace App\Models\Traits;

use App\Models\Feedback;

trait HasFeedback
{
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
