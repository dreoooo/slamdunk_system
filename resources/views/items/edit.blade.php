@extends('layouts.app')

@section('title', 'Edit Item')
@section('page-title', 'Edit Item')

@section('content')
    <x-card title="Edit Item">
        <form action="{{ route('items.update', $item->itm_number) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <x-form-input name="id" label="Item ID" value="{{ $item->itm_number }}" readonly />
            <x-form-input name="name" label="Item Name" value="{{ old('name', $item->name) }}" />
            <x-form-input name="category" label="Category" value="{{ old('category', $item->category) }}" />
            <x-form-input name="color" label="Color" value="{{ old('color', $item->color) }}" />
            <x-form-input name="size" label="Size" value="{{ old('size', $item->size) }}" />
            <x-form-input name="description" label="Description" value="{{ old('description', $item->description) }}" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Inventory List (optional)</label>
                <select name="ilt_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Inventory --</option>
                    @foreach ($inventories as $inventory)
                        <option value="{{ $inventory->id }}"
                            {{ old('ilt_id', $item->ilt_id) == $inventory->id ? 'selected' : '' }}>
                            {{ $inventory->id }} | ₱{{ $inventory->cost }} | Units: {{ $inventory->units }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button type="submit" class="bg-yellow-400 hover:bg-yellow-500">Update Item</x-button>
        </form>
    </x-card>
@endsection
