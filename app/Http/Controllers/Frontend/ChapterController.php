<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::all();
        return view('frontend.chapters.index', compact('chapters'));
    }

    public function create()
    {
        return view('frontend.chapters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        Chapter::create($request->all());

        return redirect()->route('chapters.index')->with('success', 'Chapitre ajouté avec succès');
    }

    public function edit(Chapter $chapter)
    {
        return view('frontend.chapters.edit', compact('chapter'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'name' => 'required|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $chapter->update($request->all());

        return redirect()->route('chapters.index')->with('success', 'Chapitre mis à jour avec succès');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('chapters.index')->with('success', 'Chapitre supprimé avec succès');
    }
}
