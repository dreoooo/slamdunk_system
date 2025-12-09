<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PriceHistoryController extends Controller
{
    /**
     * Display a listing of price history.
     */
    public function index()
    {
        $priceHistory = PriceHistory::with('item')->get();
        return view('price-history.index', compact('priceHistory'));
    }

    /**
     * Show the form for creating a new price history.
     */
    public function create()
    {
        $items = Item::all();
        return view('price-history.create', compact('items'));
    }

    /**
     * Store a newly created price history in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'itm_number' => 'required|exists:items,itm_number',
            'price'      => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'end_time'   => 'nullable',
        ]);

        // Ensure TIME format HH:MM:SS for MySQL
        $validated['start_time'] .= ':00';
        if (!empty($validated['end_time'])) {
            $validated['end_time'] .= ':00';
        }

        PriceHistory::create($validated);

        return redirect()->route('price-history.index')
            ->with('success', 'Price added successfully.');
    }

    /**
     * Show the form for editing the specified price history.
     */
    public function edit($itm_number, $start_date, $start_time)
    {
        $priceHistory = PriceHistory::where('itm_number', $itm_number)
            ->where('start_date', $start_date)
            ->where('start_time', $start_time)
            ->firstOrFail();

        $items = Item::all();

        return view('price-history.edit', compact('priceHistory', 'items'));
    }

    /**
     * Update the specified price history in storage.
     */
    public function update(Request $request, $itm_number, $start_date, $start_time)
    {
        $validated = $request->validate([
            'price'      => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'end_time'   => 'nullable',
        ]);

        $validated['start_time'] .= ':00';
        if (!empty($validated['end_time'])) {
            $validated['end_time'] .= ':00';
        }

        // Update via query since no primary key
        PriceHistory::where('itm_number', $itm_number)
            ->where('start_date', $start_date)
            ->where('start_time', $start_time)
            ->update($validated);

        return redirect()->route('price-history.index')
            ->with('success', 'Price updated successfully.');
    }

    /**
     * Remove the specified price history from storage.
     */
    public function destroy($itm_number, $start_date, $start_time)
    {
        PriceHistory::where('itm_number', $itm_number)
            ->where('start_date', $start_date)
            ->where('start_time', $start_time)
            ->delete();

        return redirect()->route('price-history.index')
            ->with('success', 'Price deleted successfully.');
    }
}
