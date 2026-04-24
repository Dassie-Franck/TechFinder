<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::paginate(15);
        return view('utilisateur.index', compact('utilisateurs'));
    }

    public function create()
    {
        return view('utilisateur.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom_user'      => 'required|string|max:100',
            'prenom_user'   => 'required|string|max:100',
            'login_user'    => 'required|string|max:80|unique:utilisateurs,login_user',
            'password_user' => 'required|string|min:6',
            'tel_user'      => 'nullable|string|max:20',
            'sexe_user'     => 'required|in:M,F',
            'role_user'     => 'required|in:admin,technicien,client',
            'etat_user'     => 'required|in:actif,inactif',
        ]);

        // Génère un code_user unique ex: USR-xxxx
        $data['code_user']     = 'USR-' . strtoupper(Str::random(6));
        $data['password_user'] = bcrypt($data['password_user']);

        Utilisateur::create($data);

        return redirect()->route('web.utilisateur.index')
                         ->with('success', 'Utilisateur créé avec succès.');
    }

    public function show($code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);
        return view('utilisateur.show', compact('utilisateur'));
    }

    public function edit($code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);
        return view('utilisateur.form', compact('utilisateur'));
    }

    public function update(Request $request, $code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);

        $data = $request->validate([
            'nom_user'      => 'required|string|max:100',
            'prenom_user'   => 'required|string|max:100',
            'login_user'    => 'required|string|max:80|unique:utilisateurs,login_user,' . $code_user . ',code_user',
            'password_user' => 'nullable|string|min:6',
            'tel_user'      => 'nullable|string|max:20',
            'sexe_user'     => 'required|in:M,F',
            'role_user'     => 'required|in:admin,technicien,client',
            'etat_user'     => 'required|in:actif,inactif',
        ]);

        if (empty($data['password_user'])) {
            unset($data['password_user']);
        } else {
            $data['password_user'] = bcrypt($data['password_user']);
        }

        $utilisateur->update($data);

        return redirect()->route('web.utilisateur.index')
                         ->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy($code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);
        $utilisateur->delete();

        return redirect()->route('web.utilisateur.index')
                         ->with('success', 'Utilisateur supprimé.');
    }
}
