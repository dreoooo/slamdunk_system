@extends('layouts.app')

@section('title', 'Add Item')
@section('page-title', 'Add Item')

@section('content')
    <x-card title="New Item">
        <form action="{{ route('items.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-form-input name="name" label="Item Name" value="{{ old('name') }}" />
            <x-form-input name="category" label="Category" value="{{ old('category') }}" />
            <x-form-input name="color" label="Color" value="{{ old('color') }}" />
            <x-form-input name="size" label="Size" value="{{ old('size') }}" />
            <x-form-input name="description" label="Description" value="{{ old('description') }}" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Inventory List (optional)</label>
                <select name="ilt_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Inventory --</option>
                    @foreach ($inventories as $inventory)
                        <option value="{{ $inventory->id }}" {{ old('ilt_id') == $inventory->id ? 'selected' : '' }}>
                            {{ $inventory->id }} | ₱{{ $inventory->cost }} | Units: {{ $inventory->units }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button type="submit" class="bg-green-500 hover:bg-green-600">Save Item</x-button>
        </form>
    </x-card>
@endsection
