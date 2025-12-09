@extends('layouts.app')

@section('title', 'Edit Inventory')
@section('page-title', 'Edit Inventory')

@section('content')
    <x-card title="Edit Inventory">
        <form action="{{ route('inventory.update', $inventory->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Inventory ID (read-only) -->
            <x-form-input name="id" label="Inventory ID" value="{{ $inventory->id }}" readonly />

            <!-- Cost -->
            <x-form-input name="cost" label="Cost" type="number" step="0.01" value="{{ $inventory->cost }}"
                required />

            <!-- Units -->
            <x-form-input name="units" label="Units" type="number" value="{{ $inventory->units }}" required />

            <!-- Submit button -->
            <x-button type="submit" class="bg-yellow-400 hover:bg-yellow-500">Update Inventory</x-button>
        </form>
    </x-card>
@endsection
