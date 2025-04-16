<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\Course;

class PlansController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Plans';
        $plans = Plan::all();
        $courses = Course::all();
        return view('frontend.plan', compact('title', 'plans', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);

        Plan::create($validated);

        return redirect()->back()->with('success', 'Plan ajouté avec succès.');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $title = 'Modifier le Plan';
        $courses = Course::all();
        return view('frontend.edit-plan', compact('title', 'plan', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'course_id' => 'required|exists:courses,id', // Validation pour un seul cours
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'course_id' => $validated['course_id'], // Mise à jour du cours associé
        ]);

        return redirect()->route('frontend.plan')->with('success', 'Plan mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return back()->with('success', 'Plan supprimé avec succès.');
    }

    public function show($id)
    {
        $plans = Plan::with('course')->findOrFail($id);
        $title = 'Détails du plan';
        return view('frontend.show-plan', compact('plans','title'));
    }
}

