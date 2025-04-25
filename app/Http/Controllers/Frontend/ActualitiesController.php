<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Actuality;
use Illuminate\Http\Request;

class ActualitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Gestionnaire Ecoles';
        $actualities = Actuality::all();
        return view('frontend.actualite', compact('title', 'actualities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données (si nécessaire)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ]);

        // Création de l'enregistrement dans la base de données
        $actuality = Actuality::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Actualité créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // Trouver l'actualité par son ID
         $actuality = Actuality::find($id);
         $title = 'Modifier Actualité';
         return view('frontend.edit-actualite', compact('title', 'actuality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données (si nécessaire)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ]);

        // Trouver l'actualité par son ID
        $actuality = Actuality::findOrFail($id);

        // Mettre à jour l'actualité
        $actuality->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('frontend.actualite')->with('success', 'Actualité modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actuality = Actuality::findOrFail($id);
        $actuality->delete();
        return back()->with('success', 'Actualité supprimé avec succès.');
    }

    public function showActualityDetails($id) 
    {
        // Récupérer l'actualité par son ID
        $actuality = Actuality::find($id);
    
        // Vérifier si l'actualité existe
        if (!$actuality) {
            return response()->json(['error' => 'Actualité introuvable'], 404);
        }
    
        return response()->json([
            'title' => $actuality->title,
            'content' => $actuality->content ?? 'N/A',  // Si le contenu est vide, on renvoie 'N/A'
        ]);
    }
}
