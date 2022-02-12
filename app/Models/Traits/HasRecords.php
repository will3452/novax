<?php

namespace App\Models\Traits;

use App\Models\Record;

trait HasRecords
{
    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
