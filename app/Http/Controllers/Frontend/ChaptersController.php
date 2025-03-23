<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Exception;

class ChaptersController extends Controller
{
    public function index()
    {
        $courses = Course::all(); // Récupère tous les cours
        $chapters = Chapter::with('course', 'parent')->get(); // Récupère tous les chapitres avec leurs relations

        return view('frontend.chapitre', compact('courses', 'chapters')); // Passe les données à la vue
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Création du chapitre
        Chapter::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'course_id' => $validated['course_id'],
        ]);

        return redirect()->back()->with('success', 'Chapitre ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le chapitre
        $chapter = Chapter::findOrFail($id);
        $title = 'Modifier Chapitre';
        return view('frontend.edit-chapitre', compact('title', 'chapter'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Trouver le chapitre
        $chapter = Chapter::findOrFail($id);

        // Mettre à jour le chapitre
        $chapter->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('frontend.chapitre')->with('success', 'Chapitre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le chapitre
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return back()->with('success', 'Chapitre supprimé avec succès.');
    }

    public function show($id)
    {
        try {
            $chapter = Chapter::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $chapter], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }
}
