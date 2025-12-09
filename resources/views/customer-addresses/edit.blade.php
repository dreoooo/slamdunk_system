@extends('layouts.app')

@section('title', 'Edit Customer Address')
@section('page-title', 'Edit Customer Address')

@section('content')
    <x-card title="Edit Customer Address">
        <form action="{{ route('customer-addresses.update', $address->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form-input name="address_line_1" label="Address Line 1"
                value="{{ old('address_line_1', $address->address_line_1) }}" />
            <x-form-input name="address_line_2" label="Address Line 2"
                value="{{ old('address_line_2', $address->address_line_2) }}" />
            <x-form-input name="city" label="City" value="{{ old('city', $address->city) }}" />
            <x-form-input name="postal_code" label="Postal Code" value="{{ old('postal_code', $address->postal_code) }}" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Customer</label>
                <select name="ctr_number" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->ctr_number }}"
                            {{ old('ctr_number', $address->ctr_number) == $customer->ctr_number ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button>Update Address</x-button>
        </form>
    </x-card>
@endsection
