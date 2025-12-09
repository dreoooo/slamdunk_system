<?php

namespace App\Http\Controllers;

use App\Models\SalesRepresentative;
use Illuminate\Http\Request;

class SalesRepresentativeController extends Controller
{
    /**
     * Display a listing of sales representatives
     */
    public function index()
    {
        $salesReps = SalesRepresentative::with('supervisor')->get();
        return view('sales-reps.index', compact('salesReps'));
    }

    /**
     * Show the form for creating a new sales representative
     */
    public function create()
    {
        $supervisors = SalesRepresentative::all();
        return view('sales-reps.create', compact('supervisors'));
    }

    /**
     * Store a newly created sales representative
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:50|unique:sales_representatives,email',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:30',
            'phone_number' => 'required|string|max:11',
            'commission_rate' => 'required|integer',
            'supervisor_id' => 'nullable|exists:sales_representatives,id',
        ]);

        // Generate a 4-character ID (e.g., S001, S002)
        $lastRep = SalesRepresentative::orderBy('id', 'desc')->first();
        $number = $lastRep ? (int) substr($lastRep->id, 1) + 1 : 1;
        $repId = 'S' . str_pad($number, 3, '0', STR_PAD_LEFT);

        SalesRepresentative::create(array_merge($validated, [
            'id' => $repId,
        ]));

        return redirect()->route('sales-reps.index')
            ->with('success', 'Sales Representative created successfully.');
    }


    /**
     * Show the form for editing a sales representative
     */
    public function edit(SalesRepresentative $salesRep)
    {
        // Exclude the current rep from the supervisor list
        $supervisors = SalesRepresentative::where('id', '!=', $salesRep->id)->get();
        return view('sales-reps.edit', compact('salesRep', 'supervisors'));
    }

    /**
     * Update an existing sales representative
     */
    public function update(Request $request, SalesRepresentative $salesRep)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:sales_representatives,email,' . $salesRep->id . ',id',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:30',
            'phone_number' => 'required|max:11',
            'commission_rate' => 'required|integer',
            'supervisor_id' => 'nullable|exists:sales_representatives,id',
        ]);

        $salesRep->update($validated);

        return redirect()->route('sales-reps.index')
            ->with('success', 'Sales Representative updated successfully.');
    }

    /**
     * Delete a sales representative
     */
    public function destroy(SalesRepresentative $salesRep)
    {
        $salesRep->delete();
        return redirect()->route('sales-reps.index')
            ->with('success', 'Sales Representative deleted successfully.');
    }
}
