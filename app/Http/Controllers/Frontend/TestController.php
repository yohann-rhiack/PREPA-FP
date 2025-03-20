<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('frontend.tests.index', compact('tests'));
    }

    public function create()
    {
        return view('frontend.tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Test::create($request->all());

        return redirect()->route('tests.index')->with('success', 'Test ajouté avec succès');
    }

    public function edit(Test $test)
    {
        return view('frontend.tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $test->update($request->all());

        return redirect()->route('tests.index')->with('success', 'Test mis à jour avec succès');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('tests.index')->with('success', 'Test supprimé avec succès');
    }
}
