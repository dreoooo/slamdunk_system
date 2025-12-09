<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with('customer')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ctr_number'      => 'required|exists:customers,ctr_number',
            'number_of_units' => 'required|integer|min:1',
            'odr_date'        => 'required|date',
        ]);

        $order = Order::create([
            'ctr_number'      => $validated['ctr_number'],
            'number_of_units' => $validated['number_of_units'],
            'odr_date'        => $validated['odr_date'],
        ]);

        return redirect()->route('orders.index')
            ->with('success', "Order {$order->odr_id} created successfully!");
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', compact('order', 'customers'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'ctr_number'      => 'required|exists:customers,ctr_number',
            'number_of_units' => 'required|integer|min:1',
            'odr_date'        => 'required|date',
        ]);

        $order->update([
            'ctr_number'      => $validated['ctr_number'],
            'number_of_units' => $validated['number_of_units'],
            'odr_date'        => $validated['odr_date'],
        ]);

        return redirect()->route('orders.index')
            ->with('success', "Order {$order->odr_id} updated successfully!");
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', "Order {$order->odr_id} deleted successfully!");
    }
}
