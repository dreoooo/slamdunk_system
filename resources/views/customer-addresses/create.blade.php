@extends('layouts.app')

@section('title', 'Add Customer Address')
@section('page-title', 'Add Customer Address')

@section('content')
    <x-card title="New Customer Address">
        <form action="{{ route('customer-addresses.store') }}" method="POST">
            @csrf

            <x-form-input name="address_line_1" label="Address Line 1" />
            <x-form-input name="address_line_2" label="Address Line 2" />
            <x-form-input name="city" label="City" />
            <x-form-input name="postal_code" label="Postal Code" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Customer</label>
                <select name="ctr_number" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->ctr_number }}">{{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button>Save Address</x-button>
        </form>
    </x-card>
@endsection
