<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Test;  // Assurez-vous que ce modèle existe
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Tests';
        $tests = Test::all();  // Récupère tous les tests
        return view('frontend.test', compact('title', 'tests'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tests,name',
            'description' => 'required|string',
        ]);

        // Création du test
        Test::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('success', 'Test ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le test par son ID
        $test = Test::findOrFail($id);
        $title = 'Modifier Test';
        return view('frontend.edit-test', compact('title', 'test'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tests,name,' . $id,
            'description' => 'required|string',
        ]);

        // Trouver le test par son ID
        $test = Test::findOrFail($id);

        // Mettre à jour le test
        $test->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('frontend.test')->with('success', 'Test mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le test
        $test = Test::findOrFail($id);
        $test->delete();

        return back()->with('success', 'Test supprimé avec succès.');
    }

    public function show($id)
    {
        try {
            $test = Test::findOrFail($id);  // Trouver le test
            return response()->json(['status' => 'success', 'data' => $test], 200); // Retourner en JSON
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Test non trouvé'], 404); // Gestion d'erreur
        }
    }
}
