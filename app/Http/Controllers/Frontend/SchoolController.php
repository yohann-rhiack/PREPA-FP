<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('frontend.schools.index', compact('schools'));
    }

    public function create()
    {
        return view('frontend.schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        School::create($request->all());

        return redirect()->route('schools.index')->with('success', 'École ajoutée avec succès');
    }

    public function edit(School $school)
    {
        return view('frontend.schools.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $school->update($request->all());

        return redirect()->route('schools.index')->with('success', 'École mise à jour avec succès');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'École supprimée avec succès');
    }
}