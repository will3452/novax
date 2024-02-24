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
            'image' => ['required',],
            'lat' => ['required'],
            'lng' => ['required'], 
        ]);

        $data['image'] = ""; 

        foreach($request->image as $image) {
            // save the image 
            $full_image_path = $image->store('public'); 
            
            $array_image_path = explode('/', $full_image_path);

            $data['image'] .= ("***" . end($array_image_path)); 
        }

        // attach some props 
        $data['user_id'] = auth()->id(); 


        Report::create($data); 
        
        alert()->success('Success', 'Report has been submitted!'); 

        return back(); 
    }
}
