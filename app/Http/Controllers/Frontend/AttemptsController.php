<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class AttemptsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Tentatives';
        $attempts = Attempt::all();
        $tests = Test::all(); 
        $users = User::all();
        return view('frontend.tentative', compact('title', 'attempts', 'tests', 'users'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'test_id' => 'required|exists:tests,id',
            'user_id' => 'required|exists:users,id',
        ]);
        

        // Création de la tentative
        Attempt::create([
            'user_id' => $validated['user_id'],
            'test_id' => $validated['test_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()->back()->with('success', 'Tentative enregistrée avec succès.');
    }

    public function edit($id)
    {
        $title = 'Modifier Tentative';
        $attempt = Attempt::findOrFail($id);
        $tests = Test::all();
        $users = User::all();
        return view('frontend.edit-tentative', compact('attempt', 'tests', 'users', 'title'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'test_id' => 'required|exists:tests,id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
        ]);

        $attempt = Attempt::findOrFail($id);

        // Mise à jour des champs
        $attempt->update([
            'user_id' => $validated['user_id'],
            'test_id' => $validated['test_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()->route('frontend.tentative')->with('success', 'Tentative mise à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer la tentative
        $attempt = Attempt::findOrFail($id);
        $attempt->delete();

        return back()->with('success', 'Tentative supprimée avec succès.');
    }

    public function show($id)
    {
        $title = 'Détails de la Tentative';
        $attempt = Attempt::with(['test', 'user'])->findOrFail($id);
        return view('frontend.show-tentative', compact('attempt','title'));
    }
}
