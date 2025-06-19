<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{
    public function create()
    {
        return view('lost.report');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'lost_date' => 'required|date',
            'location' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('lost-items', 'public');
        }

        LostItem::create([
            'user_id' => Auth::id(),
            'item_name' => $validated['item_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'lost_date' => $validated['lost_date'],
            'location' => $validated['location'],
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Lost item reported successfully.');
    }
}

