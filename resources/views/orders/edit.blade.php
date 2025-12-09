@extends('layouts.app')

@section('title', 'Edit Order')
@section('page-title', 'Edit Order')

@section('content')
    <x-card title="Edit Order">
        <form action="{{ route('orders.update', $order->odr_id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Order ID (read-only) -->
            <x-form-input name="odr_id" label="Order ID" value="{{ $order->odr_id }}" readonly />

            <!-- Customer -->
            <div>
                <label for="ctr_number" class="block text-sm font-medium text-gray-700">Customer</label>
                <select name="ctr_number" id="ctr_number" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->ctr_number }}"
                            {{ $customer->ctr_number == $order->ctr_number ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Number of units -->
            <x-form-input name="number_of_units" label="Number of Units" type="number"
                value="{{ $order->number_of_units }}" required />

            <!-- Order date -->
            <x-form-input name="odr_date" label="Order Date" type="date" value="{{ $order->odr_date->format('Y-m-d') }}"
                required />

            <!-- Submit button -->
            <x-button type="submit" class="bg-yellow-400 hover:bg-yellow-500">Update Order</x-button>
        </form>
    </x-card>
@endsection
