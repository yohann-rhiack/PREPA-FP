<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('frontend.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('frontend.subscriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Abonnement ajouté avec succès');
    }

    public function edit(Subscription $subscription)
    {
        return view('frontend.subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Abonnement mis à jour avec succès');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Abonnement supprimé avec succès');
    }
}
