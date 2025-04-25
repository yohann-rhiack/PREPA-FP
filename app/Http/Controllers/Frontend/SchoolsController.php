<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Exception;

class SchoolsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire Ecoles';
        $schools = School::all();
        return view('frontend.ecole', compact('title', 'schools'));
    }

    public function store(Request $request)
    {
        // Validation des données (si nécessaire)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Création de l'enregistrement dans la base de données
        $school = School::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('success', 'École créée avec succès');
    }

    public function edit($id)
    {
        // Trouver l'école par son ID
        $school = School::find($id);
        $title = 'Modifier Ecole';
        return view('frontend.edit-ecole', compact('title', 'school'));
   
    }

    public function update(Request $request, $id)
    {
        // Validation des données (si nécessaire)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Trouver l'école par son ID
        $school = School::findOrFail($id);

        // Mettre à jour l'école
        $school->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('frontend.ecole')->with('success', 'Ecole modifié avec succès.');
    }

    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();

        return back()->with('success', 'Ecole supprimé avec succès.');
    }

    public function showSchoolDetails($id) 
    {
        // Récupérer l'école
        $school = School::find($id);
    
        // Vérifier si l'école existe
        if (!$school) {
            return response()->json(['error' => 'École introuvable'], 404);
        }
    
        return response()->json([
            'name' => $school->name,
            'description' => $school->description ?? 'N/A',  // Si la description est vide, on renvoie 'N/A'
        ]);
    }

}
