<?php

namespace App\Http\Controllers;

use App\Models\Creatures;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'user_id' => 'required|integer|min:0',
            'avatar_blob' => 'mimes:jpeg,jpg,png|max:15360',
        ]);

        $creature = new Creatures();
        $creature->fill($formFields);

      if($request->file('avatar_blob')){
            $fileName = time() . '_' . $request->avatar_blob->getClientOriginalName();
            $creature->avatar = $fileName;
            $request->avatar_blob->move(public_path('images/uploads'), $fileName);
        }

        $creature->save();
        return response()->json($creature);
    }

    /**
     * Display the specified resource.
     */
    public function show(Creatures $creature)
    {
        return response()->json($creature);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Creatures $creature)
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
            'avatar_blob' => 'mimes:jpg,jpeg,png|max:15360'
        ]);

        $creature->fill($formFields);

        // si image présente et ancienne image existe alors suppression de l'ancienne image
        if ($request->file('avatar_blob') && File::exists(public_path('images/uploads/' . $creature->avatar))) {
          File::delete(public_path('images/uploads/' . $creature->avatar));
        }

        if ($request->file('avatar_blob')) {
          $fileName = time() . '_' . $request->avatar_blob->getClientOriginalName();
          $creature->avatar = $fileName;
          $request->avatar_blob->move(public_path('images/uploads'), $fileName);
        }

        $creature->save();
        return response()->json($creature);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creatures $creature)
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
