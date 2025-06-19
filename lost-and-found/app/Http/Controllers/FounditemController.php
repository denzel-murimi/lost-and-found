<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoundItemController extends Controller
{
    public function create()
    {
        return view('found.report');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'found_date' => 'required|date',
            'location' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $request->hasFile('photo')
            ? $request->file('photo')->store('found-items', 'public')
            : null;

        FoundItem::create([
            'user_id' => Auth::id(),
            'item_name' => $validated['item_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'found_date' => $validated['found_date'],
            'location' => $validated['location'],
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Found item reported successfully.');
    }
}

