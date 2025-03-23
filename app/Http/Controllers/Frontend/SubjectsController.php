<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Matières';
        $subjects = Subject::all();
        return view('frontend.matiere', compact('title', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'description' => 'nullable|string|max:500',
        ]);

        Subject::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Matière ajoutée avec succès.');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $title = 'Modifier Matière';
        return view('frontend.edit-matiere', compact('title', 'subject'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $id,
            'description' => 'nullable|string|max:500',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('frontend.matiere')->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return back()->with('success', 'Matière supprimée avec succès.');
    }

    public function show($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $subject], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Matière non trouvée'], 404);
        }
    }
}
