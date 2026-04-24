<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function index()
    {
        $competences = Competence::orderBy('created_at', 'desc')->paginate(10);
        return view('competence.index', compact('competences'));
    }

    public function create()
    {
        return view('competence.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label_comp'       => 'required|string|max:150',
            'description_comp' => 'nullable|string|max:1000',
        ]);

        Competence::create($validated);

        return redirect()
            ->route('competences.index')
            ->with('success', 'Compétence créée avec succès.');
    }

    public function show($code_comp)
    {
        $competence = Competence::findOrFail($code_comp);
        return view('competence.show', compact('competence'));
    }

    public function edit($code_comp)
    {
        $competence = Competence::findOrFail($code_comp);
        return view('competence.edit', compact('competence'));
    }

    public function update(Request $request, $code_comp)
    {
        $competence = Competence::findOrFail($code_comp);

        $validated = $request->validate([
            'label_comp'       => 'required|string|max:150',
            'description_comp' => 'nullable|string|max:1000',
        ]);

        $competence->update($validated);

        return redirect()
            ->route('competences.index')
            ->with('success', 'Compétence mise à jour avec succès.');
    }

    public function destroy($code_comp)
    {
        $competence = Competence::findOrFail($code_comp);
        $competence->delete();

        return redirect()
            ->route('competences.index')
            ->with('success', 'Compétence supprimée.');
    }
}

