<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cycle;

class CycleController extends Controller
{
    public function index()
    {
        $cycles = Cycle::orderBy('name', 'asc')->get();
        return view('frontend.cycles.index', compact('cycles'));
    }

    public function create()
    {
        return view('frontend.cycles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Cycle::create($request->all());

        return redirect()->route('cycles.index')->with('success', 'Cycle ajouté avec succès');
    }

    public function edit(Cycle $cycle)
    {
        return view('frontend.cycles.edit', compact('cycle'));
    }

    public function update(Request $request, Cycle $cycle)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $cycle->update($request->all());

        return redirect()->route('cycles.index')->with('success', 'Cycle mis à jour avec succès');
    }

    public function destroy(Cycle $cycle)
    {
        $cycle->delete();
        return redirect()->route('cycles.index')->with('success', 'Cycle supprimé avec succès');
    }
}
