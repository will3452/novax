<?php
namespace App\Nova;

use Illuminate\Http\Request;

trait CannotViewByStudentTrait
{
    public function authorizedToView(Request $request)
    {
        return ! auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT);
    }
}
