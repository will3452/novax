<?php

namespace App\Observers;

use App\Models\Room;
use App\Observers\Traits\HasCode;
use Illuminate\Support\Str;

class RoomObserver
{
    use HasCode;
    public function creating(Room $room)
    {
        $room->code = $this->generateCode($room);
    }
}
