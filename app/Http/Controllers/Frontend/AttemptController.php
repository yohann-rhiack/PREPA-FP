<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attempt;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::all();
        return view('frontend.attempts.index', compact('attempts'));
    }

    public function create()
    {
        return view('frontend.attempts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'test_id' => 'required|exists:tests,id',
            'score' => 'required|numeric',
        ]);

        Attempt::create($request->all());

        return redirect()->route('attempts.index')->with('success', 'Tentative ajoutée avec succès');
    }

    public function edit(Attempt $attempt)
    {
        return view('frontend.attempts.edit', compact('attempt'));
    }

    public function update(Request $request, Attempt $attempt)
    {
        $request->validate([
            'score' => 'required|numeric',
        ]);

        $attempt->update($request->all());

        return redirect()->route('attempts.index')->with('success', 'Tentative mise à jour avec succès');
    }

    public function destroy(Attempt $attempt)
    {
        $attempt->delete();
        return redirect()->route('attempts.index')->with('success', 'Tentative supprimée avec succès');
    }
}
