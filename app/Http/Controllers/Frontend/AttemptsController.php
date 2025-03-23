<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use Illuminate\Http\Request;
use Exception;

class AttemptsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Tentatives';
        $attempts = Attempt::all();
        return view('frontend.tentative', compact('title', 'attempts'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'score' => 'required|numeric',
            'exam_id' => 'required|exists:exams,id',
        ]);

        // Création de la tentative
        Attempt::create([
            'user_id' => $validated['user_id'],
            'score' => $validated['score'],
            'exam_id' => $validated['exam_id'],
        ]);

        return redirect()->back()->with('success', 'Tentative enregistrée avec succès.');
    }

    public function edit($id)
    {
        // Trouver la tentative
        $attempt = Attempt::findOrFail($id);
        $title = 'Modifier Tentative';
        return view('frontend.edit-tentative', compact('title', 'attempt'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'score' => 'required|numeric',
        ]);

        // Trouver la tentative
        $attempt = Attempt::findOrFail($id);

        // Mettre à jour la tentative
        $attempt->update([
            'score' => $validated['score'],
        ]);

        return redirect()->route('frontend.tentative')->with('success', 'Tentative mise à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer la tentative
        $attempt = Attempt::findOrFail($id);
        $attempt->delete();

        return back()->with('success', 'Tentative supprimée avec succès.');
    }

    public function show($id)
    {
        try {
            $attempt = Attempt::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $attempt], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }
}
