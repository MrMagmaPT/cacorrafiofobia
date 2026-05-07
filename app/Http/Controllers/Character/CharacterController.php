<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use App\Models\PlayerClass;
use App\Models\Race;
use Illuminate\Http\Request;
use App\Models\CharacterProfile;
use App\Models\Stat;

class CharacterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $characters = CharacterProfile::with(['race', 'playerClass', 'stats'])->get();
        return view('characters.index', compact('characters'));
    }

    public function create() {
        $races = Race::all();
        $classes = PlayerClass::all();
        return view('characters.create', compact('races', 'classes'));
    }

    public function show(CharacterProfile $character)
    {
        return view('characters.show', compact('character'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'u_name' => 'required|string|max:200',
            'u_age' => 'required|integer',
            'race_id' => 'required|exists:races,id',
            'subrace_id' => 'nullable|exists:races,id',
            'class_id' => 'required|exists:player_classes,id',
            'subclass_id' => 'nullable|exists:player_classes,id',
            'LVL' => 'required|integer',
            'aligment' => 'nullable|string',
            'money' => 'nullable|numeric',
            'hp' => 'nullable|numeric',
            // Stats fields
            'mana' => 'required|numeric',
            'defence' => 'required|numeric',
            'magic' => 'required|numeric',
            'Inte' => 'required|integer',
            'Ma' => 'required|integer',
            'Uc' => 'required|integer',
            'Lu' => 'required|integer',
            'Com' => 'required|integer',
            'Agi' => 'required|integer',
            'Str' => 'required|integer',
            'Md' => 'required|integer',
            'Con' => 'required|integer',
            'Res' => 'required|integer',
        ]);

        // 1. Create stats
        $stats = Stat::create([
            'mana'    => $validated['mana'],
            'defence' => $validated['defence'],
            'magic'   => $validated['magic'],
            'Inte'    => $validated['Inte'],
            'Ma'      => $validated['Ma'],
            'Uc'      => $validated['Uc'],
            'Lu'      => $validated['Lu'],
            'Com'     => $validated['Com'],
            'Agi'     => $validated['Agi'],
            'Str'     => $validated['Str'],
            'Md'      => $validated['Md'],
            'Con'     => $validated['Con'],
            'Res'     => $validated['Res'],
        ]);

        // 2. Create character profile
        CharacterProfile::create([
            'u_name'      => $validated['u_name'],
            'u_age'       => $validated['u_age'],
            'race_id'     => $validated['race_id'],
            'subrace_id'  => $validated['subrace_id'],
            'class_id'    => $validated['class_id'],
            'subclass_id' => $validated['subclass_id'],
            'LVL'         => $validated['LVL'],
            'aligment'    => $validated['aligment'],
            'money'       => $validated['money'],
            'hp'          => $validated['hp'],
            'stats_id'    => $stats->id,
        ]);

        return redirect()->route('characters.index')->with('success', 'Character created!');
    }

    public function destroy(CharacterProfile $character)
    {
        // Get the stats_id before deleting
        $statsId = $character->stats_id;

        // Delete the character
        $character->delete();

        // Delete associated stats
        if ($statsId) {
            Stat::find($statsId)?->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Character deleted successfully!');
    }
}
