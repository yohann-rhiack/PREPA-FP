<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Plans';
        $plans = Plan::all();
        return view('frontend.plan', compact('title', 'plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
        ]);

        Plan::create($validated);

        return redirect()->back()->with('success', 'Plan ajouté avec succès.');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $title = 'Modifier Plan';
        return view('frontend.edit-plan', compact('title', 'plan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update($validated);

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
        try {
            $plan = Plan::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $plan], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Plan non trouvé'], 404);
        }
    }
}

