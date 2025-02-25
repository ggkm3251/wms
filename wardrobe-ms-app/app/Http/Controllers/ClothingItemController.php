<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClothingItem;

class ClothingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clothingItems = ClothingItem::where('user_id', auth()->id())->get();
        return response()->json($clothingItems);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(ClothingItem $clothingItem)
    {
        if ($clothingItem->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($clothingItem);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClothingItem $clothingItem)
    {
        if ($clothingItem->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $clothingItem->delete();
        return response()->json(['message' => 'Clothing item deleted']);
    }
}
