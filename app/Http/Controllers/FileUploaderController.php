<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploaderController extends Controller
{
    public function upload()
    {
        $file = $request->file('file');
        $path = Storage::disk('local')->path("{$file->getClientOriginalName()}");

        File::append($path, $file->get());
        $file = "";
        $isDone = false;
        if ($request->has('is_last') && $request->boolean('is_last')) {
            $name = basename($path, '.part');
            $file = storage_path('app\\public\\' . $name);
            File::move($path, $file);
            $file = $name;
            $isDone = true;
        }

        return response()->json([
            'uploaded' => true,
            'is_done' => $isDone,
            'file' => $file,
        ]);
    }
}
