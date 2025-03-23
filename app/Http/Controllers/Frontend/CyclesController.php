<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use Illuminate\Http\Request;
use Exception;

class CyclesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Cycles';
        $cycles = Cycle::all();
        return view('frontend.cycle', compact('title', 'cycles'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Création du cycle
        Cycle::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Cycle ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le cycle
        $cycle = Cycle::findOrFail($id);
        $title = 'Modifier Cycle';
        return view('frontend.edit-cycle', compact('title', 'cycle'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Trouver le cycle
        $cycle = Cycle::findOrFail($id);

        // Mettre à jour le cycle
        $cycle->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

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
        try {
            $cycle = Cycle::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $cycle], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }
}
