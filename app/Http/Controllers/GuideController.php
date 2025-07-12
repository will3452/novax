<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index (Request $request) {
        if ($request->query('search')) {
            $search = $request->query('search');
            return response()->json([
                'guides' => \App\Models\Guide::where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->get()
            ]);
        }

        // Default case: return all guides
        return response()->json([
            'guides' => \App\Models\Guide::all()
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:guides,slug',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048', // Optional cover image
        ]);
        $data['organization_id'] = $request->user()->organization_id; // Assuming the user is authenticated and belongs to an organization
        $data['author_user_id'] = $request->user()->id; // Assuming the user is authenticated
        $data['cover_image'] = $request->file('cover_image', 'public') ? $request->file('cover_image')->store('covers', 'public') : null;
        $data['version'] = '1.0'; // Default version
        $data['status'] = 'DRAFT'; // Default status
        $data['published_at'] = null; // Not published yet
        $data['helpful_count'] = 0; // Default helpful count

        $guide = \App\Models\Guide::create($data);

        return response()->json([
            'message' => 'Guide created successfully',
            'guide' => $guide
        ], 201);
    }

}
