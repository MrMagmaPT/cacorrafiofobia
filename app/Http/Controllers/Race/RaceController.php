<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('races.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:races,name',
        ]);

        Race::create($validated);

        return redirect()->route('dashboard')->with('success', 'Race created successfully!');
    }

    public function show(Race $race)
    {
        return view('races.show', compact('race'));
    }

    public function destroy(Race $race)
    {
        // Check if this race is used as a main race
        if ($race->characters()->exists()) {
            return redirect()->route('races.show', $race)->with('error', 'Cannot delete this race. It is assigned to one or more characters!');
        }

        // Check if this race is used as a sub-race
        if ($race->subRaceCharacters()->exists()) {
            return redirect()->route('races.show', $race)->with('error', 'Cannot delete this race. It is assigned as a sub-race to one or more characters!');
        }

        $race->delete();
        return redirect()->route('dashboard')->with('success', 'Race deleted successfully!');
    }
}
