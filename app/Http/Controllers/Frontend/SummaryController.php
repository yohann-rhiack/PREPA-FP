<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Summary;

class SummaryController extends Controller
{
    public function index()
    {
        $summaries = Summary::all();
        return view('frontend.summaries.index', compact('summaries'));
    }

    public function create()
    {
        return view('frontend.summaries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'chapter_id' => 'required|exists:chapters,id',
        ]);

        Summary::create($request->all());

        return redirect()->route('summaries.index')->with('success', 'Résumé ajouté avec succès');
    }

    public function edit(Summary $summary)
    {
        return view('frontend.summaries.edit', compact('summary'));
    }

    public function update(Request $request, Summary $summary)
    {
        $request->validate([
            'content' => 'required',
            'chapter_id' => 'required|exists:chapters,id',
        ]);

        $summary->update($request->all());

        return redirect()->route('summaries.index')->with('success', 'Résumé mis à jour avec succès');
    }

    public function destroy(Summary $summary)
    {
        $summary->delete();
        return redirect()->route('summaries.index')->with('success', 'Résumé supprimé avec succès');
    }
}
