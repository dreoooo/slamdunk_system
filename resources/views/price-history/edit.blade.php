@extends('layouts.app')

@section('title', 'Edit Price History')
@section('page-title', 'Edit Price History')

@section('content')
    <x-card title="Edit Price History">
        <form
            action="{{ route('price-history.update', [
                'itm_number' => $priceHistory->itm_number,
                'start_date' => $priceHistory->start_date,
                'start_time' => \Carbon\Carbon::parse($priceHistory->start_time)->format('H:i'),
            ]) }}"
            method="POST">
            @csrf
            @method('PUT')

            {{-- Item (read-only) --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Item</label>
                <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100"
                    value="{{ $priceHistory->item?->name ?? '-' }}" readonly>
            </div>

            {{-- Price --}}
            <x-form-input name="price" label="Price" type="number" step="0.01"
                value="{{ old('price', $priceHistory->price) }}" required />

            {{-- Start Date & Time --}}
            <x-form-input name="start_date" label="Start Date" type="date"
                value="{{ old('start_date', $priceHistory->start_date) }}" required />
            <x-form-input name="start_time" label="Start Time" type="time"
                value="{{ old('start_time', \Carbon\Carbon::parse($priceHistory->start_time)->format('H:i')) }}" required />

            {{-- End Date & Time --}}
            <x-form-input name="end_date" label="End Date" type="date"
                value="{{ old('end_date', $priceHistory->end_date) }}" />
            <x-form-input name="end_time" label="End Time" type="time"
                value="{{ old('end_time', $priceHistory->end_time ? \Carbon\Carbon::parse($priceHistory->end_time)->format('H:i') : '') }}" />

            <x-button type="submit" class="bg-yellow-400 hover:bg-yellow-500">Update Price</x-button>
        </form>
    </x-card>
@endsection
