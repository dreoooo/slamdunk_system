@extends('layouts.app')

@section('title', 'Edit Order Item')
@section('page-title', 'Edit Order Item')

@section('content')
    <x-card title="Edit Order Item">
        <form action="{{ route('order-items.update', [$orderItem->odr_id, $orderItem->itm_number]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-medium">Order</label>
                <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100"
                    value="{{ $orderItem->order?->odr_id }} - {{ $orderItem->order?->customer?->first_name ?? '-' }}"
                    readonly>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Item</label>
                <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100"
                    value="{{ $orderItem->item?->name ?? '-' }}" readonly>
            </div>

            <x-form-input name="quantity_ordered" label="Quantity Ordered" type="number" min="1"
                value="{{ old('quantity_ordered', $orderItem->quantity_ordered) }}" required />
            <x-form-input name="quantity_shipped" label="Quantity Shipped" type="number" min="0"
                value="{{ old('quantity_shipped', $orderItem->quantity_shipped) }}" />

            <x-button type="submit" class="bg-yellow-400 hover:bg-yellow-500">Update Order Item</x-button>
        </form>
    </x-card>
@endsection
