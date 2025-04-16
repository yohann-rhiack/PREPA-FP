<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Types de tests';
        $roles = Role::all();  // Récupère tous les types
        return view('frontend.role', compact('title', 'roles'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            
        ]);

        // Création du role
        Role::create($validated);

        return redirect()->back()->with('success', 'Role ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le type par son ID
        $role = Role::findOrFail($id);
        $title = 'Modifier Role';
        return view('frontend.edit-role', compact('title', 'role'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
           
        ]);

        // Trouver le type par son ID
        $roles = Role::findOrFail($id);

        // Mettre à jour le type
        $roles->update([
            'title' => $validated['title'],
            
        ]);

        return redirect()->route('frontend.role')->with('success', 'Type mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le type
        $roles = Role::findOrFail($id);
        $roles->delete();

        return back()->with('success', 'Role supprimé avec succès.');
    }

    public function show($id)
    {
        try {
            $roles = Role::findOrFail($id);  // Trouver le role
            return response()->json(['status' => 'success', 'data' => $roles], 200); // Retourner en JSON
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Type non trouvé'], 404); // Gestion d'erreur
        }
    }
}
