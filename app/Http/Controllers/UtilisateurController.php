<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $utilisateurs = Utilisateur::all();
            return response()->json($utilisateurs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve utilisateurs','message' => $e->getMessage()], 500);
        }
    //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // "code_user" => "required|string|unique:utilisateurs,code_user",
                'nom_user' => 'required|string',
                'prenom_user' => 'required|string',
                'login_user' => 'required|string|unique:utilisateurs,login_user',
                'password_user' => 'nullable|string|min:6',
                'tel_user' => 'nullable|string',
                'sexe_user' => 'nullable|in:M,F',
                'role_user' => 'required|in:client,technicien,administrateur',
                'etat_user' => 'nullable|in:actif,inactif,bloquer'
        ]);

        try {
            $utilisateur = Utilisateur::create([
                'code_user' => substr(uniqid('user_'), 0, 15),// Génère un code utilisateur unique en utilisant uniqid() et en le préfixant avec 'user_'. La fonction substr() est utilisée pour limiter la longueur du code à 15 caractères.
                'nom_user' => $request->nom_user,
                'prenom_user' => $request->prenom_user,
                'login_user' => $request->login_user,
                'password_user' => bcrypt($request->password_user),
                'tel_user' => $request->tel_user,
                'sexe_user' => $request->sexe_user,
                'role_user' => $request->role_user,
                'etat_user' => $request->etat_user,
            ]);
            return response()->json($utilisateur, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create utilisateur','message' => $e->getMessage()], 500);//500 $
        }
    //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code_user)
    {
        try {
            $utilisateur = Utilisateur::findOrFail($code_user);
            return response()->json($utilisateur, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code_user)
    {
        $request->validate([
                'nom_user' => 'required|string',
                'prenom_user' => 'required|string',
                'login_user' => 'required|string|unique:utilisateurs,login_user,' . $code_user . ',code_user', // Cette règle de validation unique vérifie que le login_user est unique dans la table utilisateurs, mais ignore l'enregistrement actuel identifié par code_user.
                'password_user' => 'nullable|string|min:6',
                'tel_user' => 'nullable|string',
                'sexe_user' => 'nullable|in:M,F',
                'role_user' => 'required|in:client,technicien,administrateur',
                'etat_user' => 'nullable|in:actif,inactif,bloquer'
            ]);

        try {
            $utilisateur = Utilisateur::findOrFail($code_user);
            $utilisateur->update([
                'nom_user' => $request->nom_user,
                'prenom_user' => $request->prenom_user,
                'login_user' => $request->login_user,
                'password_user' => $request->password_user,
                'tel_user' => $request->tel_user,
                'sexe_user' => $request->sexe_user,
                'role_user' => $request->role_user,
                'etat_user' => $request->etat_user,
            ]);
            return response()->json($utilisateur, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update user','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code_user)
    {
        try {
            $utilisateur = Utilisateur::findOrFail($code_user);
            $utilisateur->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete user','message' => $e->getMessage()], 500);
        }
    }
}
