@extends('layouts.app')

@section('title', 'Add Order Item')
@section('page-title', 'Add Order Item')

@section('content')
    <x-card title="New Order Item">
        <form action="{{ route('order-items.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Order</label>
                <select name="odr_id" class="w-full border rounded px-3 py-2 @error('odr_id') border-red-500 @enderror"
                    required>
                    <option value="">Select Order</option>
                    @foreach ($orders as $order)
                        <option value="{{ $order->odr_id }}" {{ old('odr_id') == $order->odr_id ? 'selected' : '' }}>
                            {{ $order->odr_id }} - {{ $order->customer?->first_name ?? '-' }}
                        </option>
                    @endforeach
                </select>
                @error('odr_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Item</label>
                <select name="itm_number"
                    class="w-full border rounded px-3 py-2 @error('itm_number') border-red-500 @enderror" required>
                    <option value="">Select Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->itm_number }}"
                            {{ old('itm_number') == $item->itm_number ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('itm_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input name="quantity_ordered" label="Quantity Ordered" type="number" min="1"
                value="{{ old('quantity_ordered', 1) }}" required />
            <x-form-input name="quantity_shipped" label="Quantity Shipped" type="number" min="0"
                value="{{ old('quantity_shipped', 0) }}" />

            <x-button type="submit" class="bg-green-500 hover:bg-green-600">Save Order Item</x-button>
        </form>
    </x-card>
@endsection
