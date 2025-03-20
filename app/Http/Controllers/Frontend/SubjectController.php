<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('frontend.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('frontend.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Matière ajoutée avec succès');
    }

    public function edit(Subject $subject)
    {
        return view('frontend.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Matière mise à jour avec succès');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Matière supprimée avec succès');
    }
}
