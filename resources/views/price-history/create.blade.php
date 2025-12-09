@extends('layouts.app')

@section('title', 'Add Price History')
@section('page-title', 'Add Price History')

@section('content')
    <x-card title="Add New Price History">
        <form action="{{ route('price-history.store') }}" method="POST">
            @csrf

            {{-- Item --}}
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

            {{-- Price --}}
            <x-form-input name="price" label="Price" type="number" step="0.01" value="{{ old('price') }}"
                required />

            {{-- Start Date & Time --}}
            <x-form-input name="start_date" label="Start Date" type="date" value="{{ old('start_date') }}" required />
            <x-form-input name="start_time" label="Start Time" type="time" value="{{ old('start_time') }}" required />

            {{-- End Date & Time --}}
            <x-form-input name="end_date" label="End Date" type="date" value="{{ old('end_date') }}" />
            <x-form-input name="end_time" label="End Time" type="time" value="{{ old('end_time') }}" />

            <x-button type="submit" class="bg-green-500 hover:bg-green-600">Save Price</x-button>
        </form>
    </x-card>
@endsection
