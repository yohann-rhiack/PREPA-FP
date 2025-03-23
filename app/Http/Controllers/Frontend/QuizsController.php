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
            'options' => 'required|array|min:2', // Minimum 2 options
            'options.*' => 'required|string|max:255', // Chaque option doit être une chaîne
            'correct_option' => 'required|string|max:255',
        ]);

        Quiz::create([
            'question' => $validated['question'],
            'options' => json_encode($validated['options']), // Stockage en JSON
            'correct_option' => $validated['correct_option'],
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
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'correct_option' => 'required|string|max:255',
        ]);

        $question = Quiz::findOrFail($id);
        $question->update([
            'question' => $validated['question'],
            'options' => json_encode($validated['options']),
            'correct_option' => $validated['correct_option'],
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
