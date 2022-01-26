<?php

namespace App\Nova;

use Illuminate\Http\Request;

trait CannotModifyByStudentTrait {
    public static function authorizedToCreate(Request $request)
    {
        return ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT);
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true;
        }
        return ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT);
    }

    public function authorizedToDelete(Request $request)
    {
        return ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT);
    }
}
