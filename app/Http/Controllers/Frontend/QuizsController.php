<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Questions';
        $questions = Quiz::all();
        return view('frontend.question', compact('title', 'questions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'tag' => 'nullable|string|max:255', // Tag est facultatif
        ]);

        Quiz::create([
            'question' => $validated['question'],
            'tag' => $validated['tag'] ?? null, // Si le tag est fourni, on l'ajoute, sinon il est null
        ]);

        return redirect()->back()->with('success', 'Question ajoutée avec succès.');
    }

    public function edit($id)
    {
        $question = Quiz::findOrFail($id);
        $title = 'Modifier Question';
        return view('frontend.edit-question', compact('title', 'question'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'tag' => 'nullable|string|max:255', // Tag est facultatif
        ]);

        $question = Quiz::findOrFail($id);
        $question->update([
            'question' => $validated['question'],
            'tag' => $validated['tag'] ?? null, // Si le tag est fourni, on l'ajoute, sinon il est null
        ]);

        return redirect()->route('frontend.question')->with('success', 'Question mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $question = Quiz::findOrFail($id);
        $question->delete();

        return back()->with('success', 'Question supprimée avec succès.');
    }

    public function show($id)
    {
        try {
            $question = Quiz::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $question], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Question non trouvée'], 404);
        }
    }
}
