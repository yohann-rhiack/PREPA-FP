<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Types de tests';
        $types = Type::all();  // Récupère tous les types
        return view('frontend.type', compact('title', 'types'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            
        ]);

        // Création du type
        Type::create($validated);

        return redirect()->back()->with('success', 'Type ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le type par son ID
        $type = Type::findOrFail($id);
        $title = 'Modifier Type';
        return view('frontend.edit-type', compact('title', 'type'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
           
        ]);

        // Trouver le type par son ID
        $types = Type::findOrFail($id);

        // Mettre à jour le type
        $types->update([
            'title' => $validated['title'],
            
        ]);

        return redirect()->route('frontend.type')->with('success', 'Type mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le type
        $types = Type::findOrFail($id);
        $types->delete();

        return back()->with('success', 'Type supprimé avec succès.');
    }

    public function show($id)
    {
        try {
            $types = Type::findOrFail($id);  // Trouver le type
            return response()->json(['status' => 'success', 'data' => $types], 200); // Retourner en JSON
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Type non trouvé'], 404); // Gestion d'erreur
        }
    }
}
