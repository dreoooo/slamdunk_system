@extends('layouts.app')

@section('title', 'Add Sales Rep Address')
@section('page-title', 'Add Sales Rep Address')

@section('content')
    <x-card title="New Sales Rep Address">
        <form action="{{ route('sales-rep-addresses.store') }}" method="POST">
            @csrf
            <!-- ID will be auto-generated, no input needed -->

            <x-form-input name="address_line_1" label="Address Line 1" />
            <x-form-input name="address_line_2" label="Address Line 2" />
            <x-form-input name="city" label="City" />
            <x-form-input name="postal_code" label="Postal Code" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Sales Rep</label>
                <select name="sre_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Sales Rep</option>
                    @foreach ($salesReps as $rep)
                        <option value="{{ $rep->id }}">{{ $rep->first_name }} {{ $rep->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-button>Save Address</x-button>
        </form>
    </x-card>
@endsection
