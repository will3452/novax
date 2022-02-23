<?php

namespace App\Observers;

use App\Models\Module;
use App\Models\Subject;
use App\Observers\Traits\HasCode;

class ModuleObserver
{
    use HasCode;
    public function creating(Module $module)
    {
        $yearLevel = Subject::find($module->subject_id)->code;
        $module->code = $this->generateCode($module, $yearLevel);
        $module->uploader_id = auth()->id();
    }
}
