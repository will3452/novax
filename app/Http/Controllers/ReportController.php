<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'category_id' => ['required'],
            'description' => ['required'],
            'image' => ['image', 'required', 'max:5000'],
            'lat' => ['required'],
            'lng' => ['required'], 
        ]);

        // save the image 
        $full_image_path = $request->image->store('public'); 
        
        $array_image_path = explode('/', $full_image_path);

        $data['image'] = end($array_image_path); 

        // attach some props 
        $data['user_id'] = auth()->id(); 


        Report::create($data); 
        
        alert()->success('Success', 'Report has been submitted!'); 

        return back(); 
        
    }
}
