<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('frontend.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('frontend.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Cours ajouté avec succès');
    }

    public function edit(Course $course)
    {
        return view('frontend.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Cours mis à jour avec succès');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Cours supprimé avec succès');
    }
}
