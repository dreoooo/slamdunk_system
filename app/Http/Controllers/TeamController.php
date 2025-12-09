<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the teams.
     */
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created team in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'number_of_players' => 'required|integer|min:1',
            'discount' => 'nullable|integer|min:0',
        ]);

        // Generate a 4-character ID (e.g., T001, T002, ...)
        $lastTeam = Team::orderBy('id', 'desc')->first();
        $number = $lastTeam ? (int) substr($lastTeam->id, 1) + 1 : 1;
        $teamId = 'T' . str_pad($number, 3, '0', STR_PAD_LEFT); // T001, T002, etc.

        Team::create([
            'id' => $teamId,
            'name' => $request->name,
            'number_of_players' => $request->number_of_players,
            'discount' => $request->discount ?? 0,
        ]);

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }


    /**
     * Show the form for editing the specified team.
     */
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified team in storage.
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number_of_players' => 'required|integer|min:1',
            'discount' => 'nullable|integer|min:0',
        ]);

        $team->update($validated);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    /**
     * Remove the specified team from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}
