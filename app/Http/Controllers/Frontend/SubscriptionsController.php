<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscription; // Assurez-vous que ce modèle existe
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Abonnements';
        $subscriptions = Subscription::all();
        return view('frontend.abonnement', compact('title', 'subscriptions'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        // Création de l'abonnement
        Subscription::create([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
        ]);

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Abonnement ajouté avec succès.');
    }
    
    public function edit($id)
    {
        // Trouver l'abonnement par son ID
        $subscription = Subscription::findOrFail($id);
        $title = 'Modifier Abonnement';
        return view('frontend.edit-abonnement', compact('title', 'subscription'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subscriptions,name,' . $id,
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        // Trouver l'abonnement par son ID
        $subscription = Subscription::findOrFail($id);

        // Mettre à jour l'abonnement
        $subscription->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'duration' => $validated['duration'],
        ]);

        return redirect()->route('frontend.abonnement')->with('success', 'Abonnement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Trouver et supprimer l'abonnement
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return back()->with('success', 'Abonnement supprimé avec succès.');
    }
    

    public function show($id)
    {
        try {
            $subscription = Subscription::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $subscription], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Abonnement non trouvé'], 404);
        }
    }
}
