<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Exception;

class AnswersController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Réponses';
        $questions = Quiz::all(); // Récupère toutes les questions
        $answers = Answer::all(); // Récupère toutes les réponses
        return view('frontend.reponse', compact('title', 'answers','questions'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'question_id' => 'required|exists:questions,id',
        ]);

        // Création de la réponse
        Answer::create([
            'content' => $validated['content'],
            'question_id' => $validated['question_id'],
        ]);

        return redirect()->back()->with('success', 'Réponse ajoutée avec succès.');
    }

    public function edit($id)
    {
        // Trouver la réponse
        $answer = Answer::findOrFail($id);
        $title = 'Modifier Réponse';
        return view('frontend.edit-reponse', compact('title', 'answer'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Trouver la réponse
        $answer = Answer::findOrFail($id);

        // Mettre à jour la réponse
        $answer->update([
            'content' => $validated['content'],
        ]);

        return redirect()->route('frontend.reponse')->with('success', 'Réponse mise à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer la réponse
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return back()->with('success', 'Réponse supprimée avec succès.');
    }

    public function show($id)
    {
        try {
            $answer = Answer::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $answer], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }
}
