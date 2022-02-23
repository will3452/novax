<?php

namespace App\Models\Traits;

use App\Models\Room;

trait HasRoom
{
    // teacher room
    public function room()
    {
        return $this->hasOne(Room::class, 'teacher_id');
    }
}
