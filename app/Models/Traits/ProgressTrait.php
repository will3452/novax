<?php

namespace App\Models\Traits;

use App\Models\Allergy;
use App\Models\Progress;

trait ProgressTrait {
    public function progress () {
        return $this->hasMany(Progress::class, 'user_id');
    }

    public function allergies () {
        return $this->hasMany(Allergy::class, 'user_id');
    }
}
