<?php

namespace App\Http\Controllers;

use App\Models\HelpfulCount;
use Illuminate\Http\Request;
use Laravel\Nova\Cards\Help;
use ParagonIE\ConstantTime\Hex;

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
            'status' => 'nullable',
            'category' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048', // Optional cover image
        ]);
        // dd($data);
        $data['organization_id'] = $request->user()->organization_id; // Assuming the user is authenticated and belongs to an organization
        $data['author_user_id'] = $request->user()->id; // Assuming the user is authenticated
        $data['cover_image'] = $request->file('cover_image', 'public') ? $request->file('cover_image')->store('covers', 'public') : null;
        $data['version'] = '1.0'; // Default version
        $data['status'] = $data['status'] ? $data['status']: 'DRAFT'; // Default status
        $data['published_at'] = $data['status'] === 'PUBLISHED' ? now() : null; // Not published yet
        $data['helpful_count'] = 0; // Default helpful count

        $guide = \App\Models\Guide::create($data);

        return response()->json([
            'message' => 'Guide created successfully',
            'guide' => $guide
        ], 201);
    }

    public function helpful(Request $request, $slug) {
        $guide = \App\Models\Guide::where('slug', $slug)->firstOrFail();
        $exists = HelpfulCount::where('guide_id', $guide->id)
            ->where('user_id', $request->user()->id) // Assuming the user is authenticated
            ->exists();

        if ($exists) {
            HelpfulCount::where('guide_id', $guide->id)
                ->where('user_id', $request->user()->id) // Assuming the user is authenticated
                ->delete();
            $guide->decrement('helpful_count');
            return response()->json([
                'message' => 'You have unmarked this guide as helpful.',
                'helpful_count' => $guide->helpful_count
            ]);
        }

        $guide->increment('helpful_count');
        HelpfulCount::create([
            'guide_id' => $guide->id,
            'user_id' => request()->user()->id // Assuming the user is authenticated
        ]);
        return response()->json([
            'message' => 'Thank you for marking this guide as helpful!',
            'helpful_count' => $guide->helpful_count
        ]);
    }

}
