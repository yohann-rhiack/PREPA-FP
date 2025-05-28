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
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'img_school' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Traitement de l'image si elle est envoyée
        $imagePath = null;
        if ($request->hasFile('img_school')) {
            $imageName = time() . '.' . $request->img_school->extension();
            $request->img_school->move(public_path('uploads/schools'), $imageName);
            $imagePath = 'uploads/schools/' . $imageName;
        }

        // Création de l'école
        $school = School::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'img_school' => $imagePath, // enregistrement du chemin de l'image
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
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'img_school' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Récupérer l'école à modifier
        $school = School::findOrFail($id);

        // Traitement de l'image si elle est envoyée
        $imagePath = $school->img_school; // Par défaut, on garde l'image existante
        if ($request->hasFile('img_school')) {
            // Supprimer l'ancienne image si elle existe
            if ($school->img_school && file_exists(public_path($school->img_school))) {
                unlink(public_path($school->img_school));
            }

            // Enregistrer la nouvelle image
            $imageName = time() . '.' . $request->img_school->extension();
            $request->img_school->move(public_path('uploads/schools'), $imageName);
            $imagePath = 'uploads/schools/' . $imageName;
        }

        // Mise à jour des données
        $school->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'img_school' => $imagePath,
        ]);

        return redirect()->route('frontend.ecole')->with('success', 'École modifiée avec succès.');
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
            'img_school' => $school->img_school ? asset($school->img_school) : null, // Renvoie le chemin de l'image
        ]);
    }

}
