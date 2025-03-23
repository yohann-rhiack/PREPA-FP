<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Exception;

class CoursesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Cours';
        $courses = Course::all();
        return view('frontend.cours', compact('title', 'courses'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Création du cours
        Course::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Cours ajouté avec succès.');
    }

    public function edit($id)
    {
        // Trouver le cours
        $course = Course::findOrFail($id);
        $title = 'Modifier Cours';
        return view('frontend.edit-cours', compact('title', 'course'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Trouver le cours
        $course = Course::findOrFail($id);

        // Mettre à jour le cours
        $course->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('frontend.cours')->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer le cours
        $course = Course::findOrFail($id);
        $course->delete();

        return back()->with('success', 'Cours supprimé avec succès.');
    }

    public function show($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $course], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }
}
