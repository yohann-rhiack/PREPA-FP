<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        // Récupère les matières avec leur cours associé
        $subjects = Subject::with('courses')->get(); // Utilisez 'course' au lieu de 'courses'

        // Récupère tous les cours disponibles
        $courses = Course::all();

        // Ajout de la variable $title
        $title = 'Liste des Matières';

        // Passe les données à la vue
        return view('frontend.matiere', compact('subjects', 'courses', 'title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:subjects,title',
            'description' => 'nullable|string|max:500',
            'course_ids' => 'required|array', // Validation pour plusieurs cours
            'course_ids.*' => 'exists:courses,id', // Chaque ID doit exister dans la table courses
        ]);

        $subject = Subject::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        $subject->courses()->sync($validated['course_ids']); // Associe les cours au sujet

        return redirect()->back()->with('success', 'Matière ajoutée avec succès.');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $title = 'Modifier Matière';
        $courses = Course::all();
        return view('frontend.edit-matiere', compact('title', 'subject','courses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        $subject->courses()->sync($validated['courses'] ?? []); // Met à jour les associations

        return redirect()->route('frontend.subject')->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return back()->with('success', 'Matière supprimée avec succès.');
    }

    public function show($id)
    {
        $subjects = Subject::with('courses')->findOrFail($id);
        $title = 'Détails de la Matière';
        return view('frontend.show-subject', compact('subjects','title'));
    }

    // public function associateCourse(Request $request, $subjectId)
    // {
    //     $validated = $request->validate([
    //         'course_id' => 'required|exists:courses,id',
    //     ]);

    //     $subject = Subject::findOrFail($subjectId);
    //     $subject->course_id = $validated['course_id'];
    //     $subject->save();

    //     return redirect()->back()->with('success', 'Cours associé à la matière avec succès.');
    // }
}
