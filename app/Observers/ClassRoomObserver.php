<?php

namespace App\Observers;

use App\Models\ClassRoom;
use Illuminate\Support\Str;

class ClassRoomObserver
{
    public function creating(ClassRoom $classRoom)
    {
        $classRoom->code = Str::of($classRoom->year_level)->snake() . "_" . Str::of($classRoom->name)->snake();
    }
}
