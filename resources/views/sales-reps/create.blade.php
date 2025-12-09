@extends('layouts.app')

@section('title', 'Add Sales Rep')
@section('page-title', 'Add Sales Representative')

@section('content')
    <x-card title="New Sales Rep">
        <form action="{{ route('sales-reps.store') }}" method="POST">
            @csrf

            <x-form-input name="first_name" label="First Name" />
            <x-form-input name="last_name" label="Last Name" />
            <x-form-input name="email" label="Email" type="email" />
            <x-form-input name="phone_number" label="Phone Number" />
            <x-form-input name="commission_rate" label="Commission (%)" type="number" step="0.01" />

            <div class="mb-4">
                <label class="block mb-1 font-medium">Supervisor</label>
                <select name="supervisor_id" class="w-full border rounded px-3 py-2">
                    <option value="">None</option>
                    @foreach ($supervisors as $sup)
                        <option value="{{ $sup->id }}">{{ $sup->first_name }} {{ $sup->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <x-button>Save Sales Rep</x-button>
        </form>
    </x-card>
@endsection
