<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClothingItem;

class ClothingItemController extends Controller
{
    // Get all clothing items for the authenticated user
    public function index(Request $request)
    {
        $query = ClothingItem::where('user_id', auth()->id());

    // Search by name
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter by category
    if ($request->has('category')) {
        $query->where('category', $request->category);
    }

    $clothingItems = $query->get();
    return response()->json($clothingItems);
    }

    // Store a new clothing item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'image_url' => 'nullable|string',
        ]);

        $clothingItem = ClothingItem::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'image_url' => $request->image_url,
        ]);

        return response()->json($clothingItem, 201);
    }

    // Show a specific clothing item
    public function show(ClothingItem $clothingItem)
    {
        if ($clothingItem->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($clothingItem);
    }

    // Update a clothing item
    public function update(Request $request, ClothingItem $clothingItem)
    {
        if ($clothingItem->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'category' => 'sometimes|string|max:255',
            'image_url' => 'nullable|string',
        ]);

        $clothingItem->update($request->all());
        return response()->json($clothingItem);
    }

    // Delete a clothing item
    public function destroy(ClothingItem $clothingItem)
    {
        if ($clothingItem->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $clothingItem->delete();
        return response()->json(['message' => 'Clothing item deleted']);
    }
}
