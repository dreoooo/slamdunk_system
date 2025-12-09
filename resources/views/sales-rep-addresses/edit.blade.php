@extends('layouts.app')

@section('title', 'Edit Sales Rep Address')
@section('page-title', 'Edit Sales Rep Address')

@section('content')
    <x-card title="Edit Sales Rep Address">
        <form action="{{ route('sales-rep-addresses.update', $salesRepAddress->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form-input name="id" label="Address ID" value="{{ $salesRepAddress->id }}" readonly />
            <x-form-input name="address_line_1" label="Address Line 1" value="{{ $salesRepAddress->address_line_1 }}" />
            <x-form-input name="address_line_2" label="Address Line 2" value="{{ $salesRepAddress->address_line_2 }}" />
            <x-form-input name="city" label="City" value="{{ $salesRepAddress->city }}" />
            <x-form-input name="postal_code" label="Postal Code" value="{{ $salesRepAddress->postal_code }}" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Sales Rep</label>
                <select name="sre_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Sales Rep</option>
                    @foreach ($salesReps as $rep)
                        <option value="{{ $rep->id }}" {{ $salesRepAddress->sre_id == $rep->id ? 'selected' : '' }}>
                            {{ $rep->first_name }} {{ $rep->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button>Update Address</x-button>
        </form>
    </x-card>
@endsection
