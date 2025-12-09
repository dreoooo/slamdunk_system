<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of items.
     */
    public function index()
    {
        $items = Item::with('inventory')->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        $inventories = Inventory::all(); // get all inventory_list records
        return view('items.create', compact('inventories'));
    }

    /**
     * Store a newly created item in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:20',
            'description' => 'nullable|string|max:50',
            'category'    => 'required|string|max:25',
            'color'       => 'nullable|string|max:15',
            'size'        => 'nullable|string|size:1',
            'ilt_id'      => 'nullable|exists:inventory_list,id', // updated table name
        ]);

        Item::create($request->only(
            'name',
            'description',
            'category',
            'color',
            'size',
            'ilt_id'
        ));

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Show the form for editing an existing item.
     */
    public function edit(Item $item)
    {
        $inventories = Inventory::all();
        return view('items.edit', compact('item', 'inventories'));
    }

    /**
     * Update an existing item in the database.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'        => 'required|string|max:20',
            'description' => 'nullable|string|max:50',
            'category'    => 'required|string|max:25',
            'color'       => 'nullable|string|max:15',
            'size'        => 'nullable|string|size:1',
            'ilt_id'      => 'nullable|exists:inventory_list,id', // updated table name
        ]);

        $item->update($request->only(
            'name',
            'description',
            'category',
            'color',
            'size',
            'ilt_id'
        ));

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Delete an item from the database.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }
}
