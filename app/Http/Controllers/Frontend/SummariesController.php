<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Summary; // Assurez-vous que ce modèle existe
use Illuminate\Http\Request;

class SummariesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Résumés';
        $summaries = Summary::all();  // Récupère tous les résumés
        return view('frontend.resume', compact('title', 'summaries'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:summaries,title',
            'content' => 'required|string',
        ]);

        // Création du résumé
        Summary::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Résumé ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le résumé par son ID
        $summary = Summary::findOrFail($id);
        $title = 'Modifier Résumé';
        return view('frontend.edit-resume', compact('title', 'summary'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:summaries,title,' . $id,
            'content' => 'required|string',
        ]);

        // Trouver le résumé par son ID
        $summary = Summary::findOrFail($id);

        // Mettre à jour le résumé
        $summary->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('frontend.resume')->with('success', 'Résumé mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le résumé
        $summary = Summary::findOrFail($id);
        $summary->delete();

        return back()->with('success', 'Résumé supprimé avec succès.');
    }

    public function show($id)
    {
        try {
            $summary = Summary::findOrFail($id);  // Trouver le résumé
            return response()->json(['status' => 'success', 'data' => $summary], 200); // Retourner en JSON
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Résumé non trouvé'], 404); // Gestion d'erreur
        }
    }
}
