<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;

class CyclesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Cycles';
        $cycles = Cycle::all();
        $subjects = Subject::all(); 
        return view('frontend.cycle', compact('title', 'cycles', 'subjects'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_ids' => 'required|array', // Assurez-vous que c'est un tableau
            'subject_ids.*' => 'exists:subjects,id', // Vérifier que chaque ID existe
        ]);
    
        // Création du cycle
        $cycle = Cycle::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);
    
        // Attacher les matières sélectionnées dans la table pivot
        $cycle->subjects()->attach($validated['subject_ids']);
    
        return redirect()->back()->with('success', 'Cycle ajouté avec succès avec les matières.');
    }
    


    public function edit($id)
    {
        // Trouver le cycle
        $cycle = Cycle::with('subjects')->findOrFail($id);
        $subjects = Subject::all(); // Récupère toutes les matières
        $title = 'Modifier Cycle';
        return view('frontend.edit-cycle', compact('title','subjects','cycle'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subjects' => 'array',
            'subjects.*' => 'exists:subjects,id',
        ]);
    
        $cycle = Cycle::findOrFail($id);
        $cycle->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);
    
        // Mise à jour des matières associées
        $cycle->subjects()->sync($validated['subjects'] ?? []);

        return redirect()->route('frontend.cycle')->with('success', 'Cycle mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le cycle
        $cycle = Cycle::findOrFail($id);
        $cycle->delete();

        return back()->with('success', 'Cycle supprimé avec succès.');
    }

    public function show($id)
    {
        $cycle = Cycle::with('subjects')->findOrFail($id);
        $title = 'Détails du Cycle';
        return view('frontend.show-cycle', compact('cycle','title'));
    }

}
