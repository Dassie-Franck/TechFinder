<?php

namespace App\Http\Controllers;

use App\Models\UserCompetence;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class UserCompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $userCompetences = UserCompetence::all();
            return response()->json($userCompetences, 200); 
        } catch (\Exception $e){
            return response()->json(['error' => 'Failed to retrieve competences','message' => $e->getMessage()], 500);
        }
    //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "code_user" => "required|exists:utilisateurs,code_user",
            "code_comp" => "required|exists:competences,code_comp"
        ]);
        try{
            $userCompetence = UserCompetence::create([
                'code_user' => $request->code_user,
                'code_comp' => $request->code_comp,
            ]);
            return response()->json($userCompetence, 201);
        } catch (\Exception $e){
            return response()->json(['error' => 'Failed to create usercompetence','message' => $e->getMessage()], 500);
        } 
    //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code_user, int $code_comp)
    {
       try{
            $userCompetence = UserCompetence::where('code_user', $code_user)->where('code_comp', $code_comp)->firstOrFail();
            return response()->json($userCompetence, 200);
        } catch (\Exception $e){
            return response()->json(['error' => 'Failed to retrieve usercompetence','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code_user, int $code_comp)
    {
        $request->validate([
            "code_user" => "required|exists:utilisateurs,code_user",
            "code_comp" => "required|exists:competences,code_comp"
        ]);

        try {
            $userCompetence = UserCompetence::where('code_user', $code_user)->where('code_comp', $code_comp)->firstOrFail();
            $userCompetence->update([
                'code_user' => $request->code_user,
                'code_comp' => $request->code_comp,
            ]);
            return response()->json($userCompetence, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update usercompetence','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code_user, int $code_comp)
    {
        try {
            $userCompetence = UserCompetence::where('code_user', $code_user)->where('code_comp', $code_comp)->firstOrFail();
            $userCompetence->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete usercompetence','message' => $e->getMessage()], 500);
        }
    }
}
