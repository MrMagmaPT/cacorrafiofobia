<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CharacterProfile;
use App\Models\Item;
use App\Models\PlayerClass;
use App\Models\Race;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Check if user is admin
        if (!$user->isAdmin) {
            abort(403, 'Unauthorized access');
        }

        // Get all data with relationships
        $characters = CharacterProfile::with('stats', 'race', 'playerClass', 'subRace', 'subClass')->get();
        $classes = PlayerClass::all();
        $races = Race::all();
        $items = Item::all();

        return view('dashboard.index', compact('characters', 'classes', 'races', 'items'));
    }
}
