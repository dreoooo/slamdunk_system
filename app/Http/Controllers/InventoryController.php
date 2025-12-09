<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the inventory.
     */
    public function index()
    {
        $inventories = Inventory::all(); // no need to load items
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new inventory.
     */
    public function create()
    {
        return view('inventory.create'); // no items needed
    }

    /**
     * Store a newly created inventory.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cost'  => 'required|numeric|min:0',
            'units' => 'required|integer|min:0',
        ]);

        Inventory::create([
            'cost'  => $request->cost,
            'units' => $request->units,
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory added successfully.');
    }

    /**
     * Show the form for editing inventory.
     */
    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory')); // no items needed
    }

    /**
     * Update the inventory.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'cost'  => 'required|numeric|min:0',
            'units' => 'required|integer|min:0',
        ]);

        $inventory->update([
            'cost'  => $request->cost,
            'units' => $request->units,
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    /**
     * Delete inventory.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory deleted successfully.');
    }
}
