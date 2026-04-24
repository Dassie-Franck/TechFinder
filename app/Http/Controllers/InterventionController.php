<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $interventions = Intervention::all();
            return response()->json($interventions, 200);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Failed to retrieve interventions','message' => $e->getMessage()], 500);
        }
    //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "date_int" => "required|date",
            "note_int" => "required|string",
            "commentaire_int" => "nullable|string",
            "code_user_client" => "required|exists:utilisateurs,code_user",
            "code_user_techn" => "required|exists:utilisateurs,code_user",
            "code_comp" => "required|exists:competences,code_comp"
        ]);
        try{
            $intervention = Intervention::create([
                'date_int' => $request->date_int,
                'note_int' => $request->note_int,
                'commentaire_int' => $request->commentaire_int,
                'code_user_techn' => $request->code_user_techn,
                'code_user_client' => $request->code_user_client,
                'code_comp' => $request->code_comp,
            ]);
            return response()->json($intervention, 201);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Failed to create Intervention','message' => $e->getMessage()], 500);
        }
    //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $code_int)
    {
        try {
            $intervention = Intervention::findOrfail($code_int);
            return response()->json($intervention, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve intervention','message' => $e->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_int)
    {
        $request->validate([
            "date_int" => "required|date",
            "note_int" => "required|string",
            "commentaire_int" => "nullable|string",
            "code_user_client" => "required|exists:utilisateurs,code_user",
            "code_user_techn" => "required|exists:utilisateurs,code_user",
            "code_comp" => "required|exists:competences,code_comp"
        ]);

        try{
            $intervention = Intervention::findOrfail($code_int);
            $intervention = Intervention::update([
                'date_int' => $request->date_int,
                'note_int' => $request->note_int,
                'commentaire_int' => $request->commentaire_int,
                'code_user_client' => $request->code_user_client,
                'code_user_techn' => $request->code_user_techn,
                'code_comp' => $request->code_comp,
            ]);
            return response()->json($intervention, 201);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Failed to update Intervention','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_int)
    {
        try {
            $intervention = Intervention::findOrfail($code_int);
            $intervention->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Intervention','message' => $e->getMessage()], 500);
        }

    //
    }
}
