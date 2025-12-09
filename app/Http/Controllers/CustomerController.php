<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Team;
use App\Models\SalesRepresentative;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index()
    {
        // Eager load team and sales representative
        $customers = Customer::with(['team', 'salesRep'])->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        $teams = Team::all();
        $salesReps = SalesRepresentative::all();
        return view('customers.create', compact('teams', 'salesReps'));
    }

    /**
     * Store a newly created customer in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'                => 'required|email|unique:customers,email',
            'first_name'           => 'required|string|max:20',
            'last_name'            => 'required|string|max:30',
            'phone_number'         => 'required|string|max:11',
            'current_balance'      => 'required|numeric',
            'loyalty_card_number'  => 'nullable|string|unique:customers,loyalty_card_number|max:6',
            'tem_id'               => 'nullable|exists:teams,id',
            'sre_id'               => 'nullable|exists:sales_representatives,id',
        ]);

        // Model auto-generates 'ctr_number'
        Customer::create($request->only(
            'email',
            'first_name',
            'last_name',
            'phone_number',
            'current_balance',
            'loyalty_card_number',
            'tem_id',
            'sre_id'
        ));

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Show the form for editing an existing customer.
     */
    public function edit(Customer $customer)
    {
        $teams = Team::all();
        $salesReps = SalesRepresentative::all();
        return view('customers.edit', compact('customer', 'teams', 'salesReps'));
    }

    /**
     * Update an existing customer in the database.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'email'                => 'required|email|unique:customers,email,' . $customer->ctr_number . ',ctr_number',
            'first_name'           => 'required|string|max:20',
            'last_name'            => 'required|string|max:30',
            'phone_number'         => 'required|string|max:11',
            'current_balance'      => 'required|numeric',
            'loyalty_card_number'  => 'nullable|string|unique:customers,loyalty_card_number,' . $customer->ctr_number . ',ctr_number',
            'tem_id'               => 'nullable|exists:teams,id',
            'sre_id'               => 'nullable|exists:sales_representatives,id',
        ]);

        $customer->update($request->only(
            'email',
            'first_name',
            'last_name',
            'phone_number',
            'current_balance',
            'loyalty_card_number',
            'tem_id',
            'sre_id'
        ));

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Delete a customer from the database.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
