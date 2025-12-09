@extends('layouts.app')

@section('title', 'Add Team')
@section('page-title', 'Add Team')

@section('content')
    <x-card title="Add New Team">
        <form action="{{ route('teams.store') }}" method="POST">
            @csrf

            <x-form-input name="name" label="Team Name" />
            <x-form-input name="number_of_players" label="Number of Players" type="number" />
            <x-form-input name="discount" label="Discount (%)" type="number" step="0.01" />

            <x-button>Add Team</x-button>
        </form>
    </x-card>
@endsection
