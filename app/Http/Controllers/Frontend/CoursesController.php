<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Summary; // Importation du modèle Summary
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

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
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'theme' => 'required|string|max:255',
            'chapter_title.*' => 'required|string|max:255',
            'chapter_description.*' => 'required|string',
            'chapter_summary_description.*' => 'required|string',
        ]);
    
        DB::transaction(function () use ($request) {
            // Création du cours
            $course = Course::create([
                'title' => $request->title,
                'content' => $request->content,
                'theme' => $request->theme,
            ]);
    
            // Ajout des chapitres avec leur résumé
            foreach ($request->chapter_title as $index => $chapterTitle) {
                $chapter = $course->chapters()->create([
                    'title' => $chapterTitle,
                    'chapter_description' => $request->chapter_description[$index],
                ]);
    
                // Création du résumé associé à ce chapitre
                Summary::create([
                    'course_id' => $course->id,
                    'chapter_id' => $chapter->id,
                    'summary_description' => $request->chapter_summary_description[$index],
                ]);
            }
        });
    
        return redirect()->back()->with('success', 'Cours ajouté avec succès.');
    }    

    public function edit($id)
    {
        // Trouver le cours
        $course = Course::with(['chapters', 'chapters.summary'])->findOrFail($id); // Charger les résumés des chapitres
        $title = 'Modifier Cours';
        return view('frontend.edit-cours', compact('title', 'course'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'theme' => 'required|string|max:255',
            'chapter_title.*' => 'required|string|max:255',
            'chapter_description.*' => 'required|string',
            'chapter_summary_description.*' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $id) {
            // Récupération du cours
            $course = Course::findOrFail($id);

            // Mise à jour du cours
            $course->update([
                'title' => $request->title,
                'content' => $request->content,
                'theme' => $request->theme
            ]);

            // Mise à jour ou suppression des chapitres existants
            foreach ($request->chapter_id ?? [] as $index => $chapterId) {
                if ($chapterId) {
                    $chapter = $course->chapters()->find($chapterId);
                    if ($chapter) {
                        // Mise à jour du chapitre
                        $chapter->update([
                            'title' => $request->chapter_title[$index],
                            'chapter_description' => $request->chapter_description[$index],
                        ]);

                        // Mise à jour ou création du résumé
                        $chapter->summary()->updateOrCreate(
                            ['chapter_id' => $chapterId],
                            ['summary_description' => $request->chapter_summary_description[$index]]
                        );
                    }
                }
            }

            // Création des nouveaux chapitres
            foreach ($request->chapter_title as $index => $chapterTitle) {
                if (!isset($request->chapter_id[$index])) {
                    $chapter = $course->chapters()->create([
                        'title' => $chapterTitle,
                        'chapter_description' => $request->chapter_description[$index],
                    ]);

                    // Création du résumé pour le nouveau chapitre
                    $chapter->summary()->create([
                        'course_id' => $course->id, // Ajout explicite de course_id
                        'summary_description' => $request->chapter_summary_description[$index],
                    ]);
                }
            }
        });

        return redirect()->route('course.show', $id)->with('success', 'Cours mis à jour avec succès.');
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
            // Charger le cours avec ses chapitres et les résumés associés
            $course = Course::with(['chapters.summary'])->findOrFail($id);
            $title = 'Détails du Cours';
            
            // Retourner la vue avec les informations du cours
            return view('frontend.show-cours', compact('title', 'course'));
        } catch (Exception $e) {
            // En cas d'erreur, rediriger avec un message d'erreur
            return redirect()->route('frontend.cours')->with('error', 'Cours introuvable.');
        }
    }

    

}
