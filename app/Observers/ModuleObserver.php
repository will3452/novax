<?php

namespace App\Observers;

use App\Helpers\ReferenceHelper;
use App\Models\Module;

class ModuleObserver
{
    public function created(Module $module)
    {
        $module->update([
            'reference_number'=>ReferenceHelper::generate('MOD', $module->id),
            'uploader_id'=>auth()->id(),
        ]);
    }
}
