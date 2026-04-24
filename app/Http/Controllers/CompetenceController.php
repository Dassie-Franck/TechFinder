<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;

class competenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $competences = Competence::all();
            return response()->json($competences, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve competences','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Search competences by keyword.
     */
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string'
        ]);

        try {
            $keyword = $request->keyword;

            $competences = Competence::where('label_comp', 'like', "%{$keyword}%")
                ->orWhere('description_comp', 'like', "%{$keyword}%")
                ->get();

            if ($competences->isEmpty()) {
                return response()->json(['message' => 'No matching competences found'], 404);
            }

            return response()->json($competences, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to search competences','message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //$request est une instance de la classe Request qui contient les données de la requête HTTP entrante. Il est utilisé pour accéder aux données envoyées par le client, telles que les paramètres de formulaire ou les données JSON.
    {
        $request->validate([
            "label_comp" => "required|string",
            "description_comp" => "required|string"
        ]); //$request permet de valider les données entrantes pour s'assurer qu'elles respectent les règles définies. Dans ce cas, on vérifie que "label_comp" et "description_comp" sont présents et sont des chaînes de caractères.

        try {
            $competence = Competence::create([
                'label_comp' => $request->label_comp,  //$request->label_comp accède à la valeur de "label_comp" envoyée dans la requête. De même, $request->description_comp accède à la valeur de "description_comp". Ces valeurs sont utilisées pour créer une nouvelle instance de Competence dans la base de données.
                'description_comp' => $request->description_comp,
            ]); 
            return response()->json($competence, 201); //response()->json() est une fonction qui retourne une réponse JSON au client. Le premier argument est les données à retourner (dans ce cas, l'objet $competence), et le second argument est le code de statut HTTP (201 signifie "Created").
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create competence','message' => $e->getMessage()], 500);//500 $
        }    
    //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $code_comp)
    {
        try {
            $competence = Competence::findOrFail($code_comp); //findOrFail() est une méthode qui tente de trouver un enregistrement dans la base de données en utilisant la clé primaire (dans ce cas, $code_comp). Si l'enregistrement n'est pas trouvé, elle lance une exception.
            return response()->json($competence, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve competence','message' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_comp)
    {
        $request->validate([
            "label_comp" => "required|string",
            "description_comp" => "required|string"
        ]);

        try {
            $competence = Competence::findOrFail($code_comp);
            $competence->update([
                'label_comp' => $request->label_comp,
                'description_comp' => $request->description_comp,
            ]);
            return response()->json($competence, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update competence','message' => $e->getMessage()], 500);
        }
    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_comp)
    {
        try {
            $competence = Competence::findOrFail($code_comp);
            $competence->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete competence','message' => $e->getMessage()], 500);
        }
    }

    
}

