<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display all order items.
     */
    public function index()
    {
        $orderItems = OrderItem::with(['order.customer', 'item'])->get();
        return view('order-items.index', compact('orderItems'));
    }

    /**
     * Show the form to create a new order item.
     */
    public function create()
    {
        $orders = Order::all();
        $items  = Item::all();
        return view('order-items.create', compact('orders', 'items'));
    }

    /**
     * Store a new order item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'odr_id'           => 'required|exists:orders,odr_id',
            'itm_number'       => 'required|exists:items,itm_number',
            'quantity_ordered' => 'required|integer|min:1',
            'quantity_shipped' => 'nullable|integer|min:0',
        ]);

        OrderItem::create($validated);

        return redirect()->route('order-items.index')
            ->with('success', 'Order Item added successfully.');
    }

    /**
     * Show the form for editing an existing order item.
     */
    public function edit($odr_id, $itm_number)
    {
        $orderItem = OrderItem::where('odr_id', $odr_id)
            ->where('itm_number', $itm_number)
            ->firstOrFail();

        $orders = Order::all();
        $items  = Item::all();

        return view('order-items.edit', compact('orderItem', 'orders', 'items'));
    }

    /**
     * Update an existing order item.
     */
    public function update(Request $request, $odr_id, $itm_number)
    {
        $validated = $request->validate([
            'quantity_ordered' => 'required|integer|min:1',
            'quantity_shipped' => 'nullable|integer|min:0',
        ]);

        // Update via query for composite key
        OrderItem::where('odr_id', $odr_id)
            ->where('itm_number', $itm_number)
            ->update($validated);

        return redirect()->route('order-items.index')
            ->with('success', 'Order Item updated successfully.');
    }

    /**
     * Delete an existing order item.
     */
    public function destroy($odr_id, $itm_number)
    {
        // Delete via query for composite key
        OrderItem::where('odr_id', $odr_id)
            ->where('itm_number', $itm_number)
            ->delete();

        return redirect()->route('order-items.index')
            ->with('success', 'Order Item deleted successfully.');
    }
}
