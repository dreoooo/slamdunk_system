@extends('layouts.app')

@section('title', 'Add Inventory')
@section('page-title', 'Add Inventory')

@section('content')
    <x-card title="New Inventory">
        <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Select Item -->
            <div class="mb-4">
                <label for="item_id" class="block mb-1 font-medium">Item</label>
                <select name="item_id" id="item_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->itm_number }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cost -->
            <x-form-input name="cost" label="Cost" type="number" step="0.01" required />

            <!-- Units -->
            <x-form-input name="units" label="Units" type="number" min="0" required />

            <!-- Submit Button -->
            <x-button type="submit" class="bg-green-500 hover:bg-green-600">Save Inventory</x-button>
        </form>
    </x-card>
@endsection
