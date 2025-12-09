<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of customer addresses.
     */
    public function index()
    {
        // Eager load the related Customer
        $addresses = CustomerAddress::with('customer')->get();
        return view('customer-addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('customer-addresses.create', compact('customers'));
    }

    /**
     * Store a newly created address in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:30',
            'address_line_2' => 'nullable|string|max:30',
            'city'           => 'required|string|max:15',
            'postal_code'    => 'required|string|max:7',
            'ctr_number'     => 'required|exists:customers,ctr_number',
        ]);

        // Auto-generate ID in the model
        CustomerAddress::create($request->only(
            'address_line_1',
            'address_line_2',
            'city',
            'postal_code',
            'ctr_number'
        ));

        return redirect()->route('customer-addresses.index')
            ->with('success', 'Address created successfully.');
    }

    /**
     * Show the form for editing an existing address.
     */
    public function edit(CustomerAddress $customerAddress)
    {
        $customers = Customer::all();
        return view('customer-addresses.edit', [
            'address'   => $customerAddress,
            'customers' => $customers,
        ]);
    }

    /**
     * Update an existing address in the database.
     */
    public function update(Request $request, CustomerAddress $customerAddress)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:30',
            'address_line_2' => 'nullable|string|max:30',
            'city'           => 'required|string|max:15',
            'postal_code'    => 'required|string|max:7',
            'ctr_number'     => 'required|exists:customers,ctr_number',
        ]);

        $customerAddress->update($request->only(
            'address_line_1',
            'address_line_2',
            'city',
            'postal_code',
            'ctr_number'
        ));

        return redirect()->route('customer-addresses.index')
            ->with('success', 'Address updated successfully.');
    }

    /**
     * Delete an address from the database.
     */
    public function destroy(CustomerAddress $customerAddress)
    {
        $customerAddress->delete();
        return redirect()->route('customer-addresses.index')
            ->with('success', 'Address deleted successfully.');
    }
}
