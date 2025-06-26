<?php

namespace App\Http\Controllers;

use App\Models\Creatures;
use App\Models\User;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Creatures::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string',
            'pv' => 'required|integer|min:0',
            'atk' => 'required|integer|min:0',
            'def' => 'required|integer|min:0',
            'speed' => 'required|integer|min:0',
            'capture_rate' => 'required|integer|min:0',
            'CreatureType' => 'required|in:ELECTRIK,WATER,FIRE',
            'CreatureRace' => 'required|in:MOUSE,DRAGON,PLANT',
        ]);

        $creature = new Creatures();
        $creature->fill($formFields);
        $creature->user_id = $request->user()->id;
        $creature->save();
        return response()->json($creature);
    }

    /**
     * Display the specified resource.
     */
    public function show(Creature $creature)
    {
        return response()->json($creature);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creature $creature)
    {
        $formFields = $request->validate([
            'name' => 'required|string',
            'pv' => 'required|integer|min:0',
            'atk' => 'required|integer|min:0',
            'def' => 'required|integer|min:0',
            'speed' => 'required|integer|min:0',
            'capture_rate' => 'required|integer|min:0',
            'CreatureType' => 'required|in:ELECTRIK,WATER,FIRE',
            'CreatureRace' => 'required|in:MOUSE,DRAGON,PLANT',
        ]);

        $creature->fill($formFields);
        $creature->save();
        return response()->json($creature);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creature $creature)
    {
        $creature->delete();
        return response()->json(['success' => 'success']);
    }


    public function getTypeRace(Request $request){
        $type = Creatures::all()->pluck('CreatureType')->unique();

        $race = Creatures::all()->pluck('CreatureRace')->unique();

        return response()->json([
            'CreatureType' => $type,
            'CreatureRace' => $race
        ]);
    }

    public function type($type)
    {
        $creatures = Creatures::where('CreatureType', $type)->get();
        return response()->json($creatures);
    }
}
