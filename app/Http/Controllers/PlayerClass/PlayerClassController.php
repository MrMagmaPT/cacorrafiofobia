<?php

namespace App\Http\Controllers\PlayerClass;

use App\Http\Controllers\Controller;
use App\Models\PlayerClass;
use Illuminate\Http\Request;

class PlayerClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:player_classes,name',
        ]);

        PlayerClass::create($validated);

        return redirect()->route('dashboard')->with('success', 'Class created successfully!');
    }

    public function show(PlayerClass $playerClass)
    {
        return view('classes.show', compact('playerClass'));
    }

    public function destroy(PlayerClass $playerClass)
    {
        // Check if this class is used as a main class
        if ($playerClass->characters()->exists()) {
            return redirect()->route('classes.show', $playerClass)->with('error', 'Cannot delete this class. It is assigned to one or more characters!');
        }

        // Check if this class is used as a sub-class
        if ($playerClass->subClassCharacters()->exists()) {
            return redirect()->route('classes.show', $playerClass)->with('error', 'Cannot delete this class. It is assigned as a sub-class to one or more characters!');
        }

        $playerClass->delete();
        return redirect()->route('dashboard')->with('success', 'Class deleted successfully!');
    }
}
