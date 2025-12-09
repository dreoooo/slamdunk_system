@extends('layouts.app')

@section('title', 'Edit Customer')
@section('page-title', 'Edit Customer')

@section('content')
    <x-card title="Edit Customer">
        <form action="{{ route('customers.update', $customer->ctr_number) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <x-form-input name="ctr_number" label="Customer Number" value="{{ $customer->ctr_number }}" readonly />
            <x-form-input name="first_name" label="First Name" value="{{ $customer->first_name }}" />
            <x-form-input name="last_name" label="Last Name" value="{{ $customer->last_name }}" />
            <x-form-input name="email" label="Email" type="email" value="{{ $customer->email }}" />
            <x-form-input name="phone_number" label="Phone Number" value="{{ $customer->phone_number }}" />
            <x-form-input name="current_balance" label="Current Balance" type="number"
                value="{{ $customer->current_balance }}" />
            <x-form-input name="loyalty_card_number" label="Loyalty Card Number"
                value="{{ $customer->loyalty_card_number }}" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Team</label>
                <select name="tem_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Team</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}" {{ $customer->tem_id == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Sales Representative</label>
                <select name="sre_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Sales Rep</option>
                    @foreach ($salesReps as $rep)
                        <option value="{{ $rep->id }}" {{ $customer->sre_id == $rep->id ? 'selected' : '' }}>
                            {{ $rep->first_name }} {{ $rep->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button type="submit" class="bg-yellow-400 hover:bg-yellow-500">Update Customer</x-button>
        </form>
    </x-card>
@endsection
