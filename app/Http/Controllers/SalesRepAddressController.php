<?php

namespace App\Http\Controllers;

use App\Models\SalesRepAddress;
use App\Models\SalesRepresentative;
use Illuminate\Http\Request;

class SalesRepAddressController extends Controller
{
    /**
     * Display a listing of sales representative addresses.
     */
    public function index()
    {
        // Load the sales representative relation
        $addresses = SalesRepAddress::with('salesRep')->get();
        return view('sales-rep-addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create()
    {
        $salesReps = SalesRepresentative::all();
        return view('sales-rep-addresses.create', compact('salesReps'));
    }

    /**
     * Store a newly created address.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sre_id' => 'required|exists:sales_representatives,id',
            'address_line_1' => 'required|string|max:30',
            'address_line_2' => 'nullable|string|max:30',
            'city' => 'required|string|max:15',
            'postal_code' => 'required|string|max:7',
        ]);

        // ID is auto-generated in the model
        SalesRepAddress::create($validated);

        return redirect()->route('sales-rep-addresses.index')
            ->with('success', 'Address created successfully.');
    }

    /**
     * Show the form for editing an address.
     */
    public function edit(SalesRepAddress $salesRepAddress)
    {
        $salesReps = SalesRepresentative::all();
        return view('sales-rep-addresses.edit', compact('salesRepAddress', 'salesReps'));
    }

    /**
     * Update an existing address.
     */
    public function update(Request $request, SalesRepAddress $salesRepAddress)
    {
        $validated = $request->validate([
            'sre_id' => 'required|exists:sales_representatives,id',
            'address_line_1' => 'required|string|max:30',
            'address_line_2' => 'nullable|string|max:30',
            'city' => 'required|string|max:15',
            'postal_code' => 'required|string|max:7',
        ]);

        $salesRepAddress->update($validated);

        return redirect()->route('sales-rep-addresses.index')
            ->with('success', 'Address updated successfully.');
    }

    /**
     * Delete a sales representative address.
     */
    public function destroy(SalesRepAddress $salesRepAddress)
    {
        $salesRepAddress->delete();

        return redirect()->route('sales-rep-addresses.index')
            ->with('success', 'Address deleted successfully.');
    }
}
