@extends('layouts.app')

@section('title', 'Edit Sales Rep')
@section('page-title', 'Edit Sales Representative')

@section('content')
    <x-card title="Edit Sales Rep">
        <form action="{{ route('sales-reps.update', $salesRep->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form-input name="id" label="Sales Rep ID" value="{{ $salesRep->id }}" readonly />
            <x-form-input name="first_name" label="First Name" value="{{ $salesRep->first_name }}" />
            <x-form-input name="last_name" label="Last Name" value="{{ $salesRep->last_name }}" />
            <x-form-input name="email" label="Email" type="email" value="{{ $salesRep->email }}" />
            <x-form-input name="phone_number" label="Phone Number" value="{{ $salesRep->phone_number }}" />
            <x-form-input name="commission_rate" label="Commission (%)" type="number" step="0.01"
                value="{{ $salesRep->commission_rate }}" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Supervisor</label>
                <select name="supervisor_id" class="w-full border rounded px-3 py-2">
                    <option value="">None</option>
                    @foreach ($supervisors as $sup)
                        <option value="{{ $sup->id }}" {{ $salesRep->supervisor_id == $sup->id ? 'selected' : '' }}>
                            {{ $sup->first_name }} {{ $sup->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button>Update Sales Rep</x-button>
        </form>
    </x-card>
@endsection
