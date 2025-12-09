@extends('layouts.app')

@section('title', 'Add Order')
@section('page-title', 'Add Order')

@section('content')
    <x-card title="New Order">
        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Select Customer --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Customer</label>
                <select name="ctr_number" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->ctr_number }}"
                            {{ old('ctr_number') == $customer->ctr_number ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Order Date --}}
            <x-form-input name="odr_date" label="Order Date" type="date" value="{{ old('odr_date') }}" required />

            {{-- Number of Units --}}
            <x-form-input name="number_of_units" label="Number of Units" type="number" min="1"
                value="{{ old('number_of_units') }}" required />

            <x-button type="submit" class="bg-green-500 hover:bg-green-600">Save Order</x-button>
        </form>
    </x-card>
@endsection
