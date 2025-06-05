<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Type; // Assurez-vous que ce modèle existe
use App\Models\Quiz; // Importation du modèle Quiz
use App\Models\Answer; // Importation du modèle Answer
use App\Models\Course; // Importation du modèle Course
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importation pour les transactions

class TestsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Tests';
        $tests = Test::with('type')->get(); // Correction de la relation
        $types = Type::all();
        $courses = Course::all();
        return view('frontend.test', compact('title', 'tests','types', 'courses'));
    }
    
    public function create()
    {
        $title = 'Créer un Nouveau Test';
        $types = Type::all(); // Récupère tous les types de tests
        $courses = Course::all(); // Récupère tous les cours
        return view('frontend.create-test', compact('title', 'types', 'courses'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:tests,title',
            'type_id' => 'required|exists:types,id',
            'course_id' => 'nullable|exists:courses,id',
            'time' => 'required|integer|min:1',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.tag' => 'nullable|string',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.content' => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);
        
    
        DB::transaction(function () use ($validated, $request) {
            
            // Création du test
            $tests = Test::create([
                'title' => $validated['title'],
                'type_id' => $validated['type_id'],
                'course_id' => $validated['course_id'] ?? null, // Ajout de l'ID du cours
                'time' => $validated['time'],
            ]);

            // Création du quiz pour chaque question
            foreach ($validated['questions'] as $questionData) {
                $quiz = Quiz::create([
                    'question' => $questionData['question'], // <-- ici 'question' au lieu de 'content'
                    'tag' => $questionData['tag'] ?? null,
                    'test_id' => $tests->id,
                ]);
            
                foreach ($questionData['answers'] as $answerData) {
                    Answer::create([
                        'content' => $answerData['content'],
                        'is_correct' =>$answerData['is_correct'], // ✅ ici aussi
                        'quiz_id' => $quiz->id,
                    ]);
                }
            }            
            
        });

        return redirect()->back()->with('success', 'Test ajouté avec succès.');
    }
    
    

    public function edit($id)
    {
        $test = Test::with('quizzes.answers')->findOrFail($id);
        $title = 'Modifier Test';
        $types = Type::all();
        $courses = Course::all();

        return view('frontend.edit-test', compact('title', 'test', 'types', 'courses'));
    }


    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:tests,title,' . $id,
            'type_id' => 'required|exists:types,id',
            'course_id' => 'nullable|exists:courses,id',
            'time' => 'required|integer|min:1',
            'questions' => 'required|array',
            'questions.*.id' => 'nullable|exists:quizzes,id', // ID facultatif pour les questions existantes
            'questions.*.question' => 'required|string',
            'questions.*.tag' => 'nullable|string',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.id' => 'nullable|exists:answers,id', // ID facultatif pour les réponses existantes
            'questions.*.answers.*.content' => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);

        DB::transaction(function () use ($validated, $id) {
            // Trouver le test par son ID
            $test = Test::findOrFail($id);

            // Mettre à jour le test
            $test->update([
                'title' => $validated['title'],
                'type_id' => $validated['type_id'],
                'course_id' => $validated['course_id'] ?? null, // Ajout de l'ID du cours
                'time' => $validated['time'],
            ]);

            // Récupérer les IDs des questions et réponses incluses dans la requête
            $questionIds = [];
            $answerIds = [];

            foreach ($validated['questions'] as $questionData) {
                $quiz = Quiz::updateOrCreate(
                    ['id' => $questionData['id'] ?? null], // Met à jour si l'ID existe, sinon crée une nouvelle question
                    [
                        'question' => $questionData['question'],
                        'tag' => $questionData['tag'] ?? null,
                        'test_id' => $test->id,
                    ]
                );

                $questionIds[] = $quiz->id;

                foreach ($questionData['answers'] as $answerData) {
                    $answer = Answer::updateOrCreate(
                        ['id' => $answerData['id'] ?? null], // Met à jour si l'ID existe, sinon crée une nouvelle réponse
                        [
                            'content' => $answerData['content'],
                            'is_correct' => $answerData['is_correct'],
                            'quiz_id' => $quiz->id,
                        ]
                    );

                    $answerIds[] = $answer->id;
                }
            }

            // Supprimer les questions non incluses dans la requête
            Quiz::where('test_id', $test->id)->whereNotIn('id', $questionIds)->delete();

            // Supprimer les réponses non incluses dans la requête
            Answer::whereNotIn('id', $answerIds)->whereIn('quiz_id', $questionIds)->delete();
        });

        return redirect()->route('frontend.test')->with('success', 'Test mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le test
        $test = Test::findOrFail($id);
        $test->delete();

        return back()->with('success', 'Test supprimé avec succès.');
    }

    public function show($id)
    {
        $title = 'Détail du Test';
        $test = Test::with(['type', 'quizzes.answers', 'course'])->findOrFail($id);
        $courses = Course::all(); // Optionnel, si tu ne l’utilises pas dans la vue, tu peux le supprimer
        return view('frontend.show-test', compact('test', 'title', 'courses'));
    }

}
