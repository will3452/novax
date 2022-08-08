<?php

namespace App\Http\Controllers;

use App\Models\FileImage;
use Illuminate\Http\Request;

class FileImageController extends Controller
{
    public function upload(Request $request) {
        $file = $request->file('file')->store('public');
        return $file;
    }
}
