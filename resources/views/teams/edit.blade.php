@extends('layouts.app')

@section('title', 'Edit Team')
@section('page-title', 'Edit Team')

@section('content')
    <x-card title="Edit Team">
        <form action="{{ route('teams.update', $team->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form-input name="id" label="Team ID" value="{{ $team->id }}" readonly />
            <x-form-input name="name" label="Team Name" value="{{ $team->name }}" />
            <x-form-input name="number_of_players" label="Number of Players" type="number"
                value="{{ $team->number_of_players }}" />
            <x-form-input name="discount" label="Discount (%)" type="number" step="0.01"
                value="{{ $team->discount }}" />

            <x-button>Update Team</x-button>
        </form>
    </x-card>
@endsection
