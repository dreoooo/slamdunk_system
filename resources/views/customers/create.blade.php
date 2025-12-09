@extends('layouts.app')

@section('title', 'Add Customer')
@section('page-title', 'Add Customer')

@section('content')
    <x-card title="New Customer">
        <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-form-input name="first_name" label="First Name" />
            <x-form-input name="last_name" label="Last Name" />
            <x-form-input name="email" label="Email" type="email" />
            <x-form-input name="phone_number" label="Phone Number" />
            <x-form-input name="current_balance" label="Current Balance" type="number" />
            <x-form-input name="loyalty_card_number" label="Loyalty Card Number" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Team</label>
                <select name="tem_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Team</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Sales Representative</label>
                <select name="sre_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Sales Rep</option>
                    @foreach ($salesReps as $rep)
                        <option value="{{ $rep->id }}">{{ $rep->first_name }} {{ $rep->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-button type="submit" class="bg-green-500 hover:bg-green-600">Save Customer</x-button>
        </form>
    </x-card>
@endsection
