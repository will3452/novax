<?php

namespace App\Http\Controllers;

use App\Models\FileImage;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;

class FileImageController extends Controller
{
    public function upload(Request $request) {
        $file = $request->file('file')->store('public');
        return $file;
    }

    public function remove(Request $request) {
        return File::delete(public_path($request->file));
    }
}
